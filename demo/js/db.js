// Base de datos de la demo: reemplaza a MySQL + PHP. Todo vive en localStorage.
import { PRODUCTOS } from "./catalogo.js";

const KEY = "tc-demo-db-v1";
const SESSION_KEY = "tc-demo-session-v1";
const CART_KEY = "tc-demo-cart-v1";

export const ROLES = { 1: "Empleado", 2: "Cliente" };
export const DEMO_PASSWORD = "demo1234";
export const DEMO_ACCOUNTS = {
  empleado: "admin@tiendasceleste.demo",
  cliente: "cliente@tiendasceleste.demo",
};

// Equivalente a password_hash() en PHP: nunca se guardan contraseñas en claro.
export async function sha256(text) {
  const buf = await crypto.subtle.digest("SHA-256", new TextEncoder().encode(text));
  return [...new Uint8Array(buf)].map((b) => b.toString(16).padStart(2, "0")).join("");
}

const USUARIOS_SEED = [
  [1000, "Andrea", "Rojas", "admin@tiendasceleste.demo", "andrearojas", 1, "cc", "1010101010", "3001112233", "Calle 72 #10-34"],
  [1001, "Camila", "Vargas", "cliente@tiendasceleste.demo", "camilav", 2, "cc", "1020202020", "3004445566", "Carrera 15 #85-20"],
  [1002, "Jhosep", "Solano", "jhosep@tiendasceleste.demo", "jhosepsol", 1, "cc", "1030303030", "3127778899", "Av. 91 #20-11"],
  [1003, "Valentina", "Borrero", "valentina@tiendasceleste.demo", "valeborr", 2, "ti", "1040404040", "3171234567", "Calle 128 #50-02"],
  [1004, "Douglas", "Ramírez", "douglas@tiendasceleste.demo", "douglasram", 2, "cc", "1050505050", "3213216540", "Calle 128 bis #7-45"],
  [1005, "Gerson", "Sánchez", "gerson@tiendasceleste.demo", "gersonsan", 2, "cc", "1060606060", "3119876543", "Av. Cali #40-12"],
  [1006, "María", "López", "maria@tiendasceleste.demo", "marialopez", 2, "cc", "1070707070", "3335557788", "Calle 123 #9-80"],
  [1007, "Juan", "Martínez", "juan@tiendasceleste.demo", "juanmartinez", 2, "cc", "1080808080", "3014567891", "Av. Principal #3-15"],
];

async function buildSeed() {
  const passHash = await sha256(DEMO_PASSWORD);
  const usuarios = USUARIOS_SEED.map(([codigo, nombre, apellido, correo, usuario, rol, tipoId, identificacion, celular, direccion]) => ({
    codigo, nombre, apellido, correo, usuario, rol, tipoId, identificacion, celular, direccion, passHash,
  }));
  const productos = PRODUCTOS.map((p) => ({ ...p }));
  const fecha = (diasAtras) => {
    const d = new Date();
    d.setDate(d.getDate() - diasAtras);
    return d.toISOString();
  };
  // [código, usuario, días atrás, [[producto, cantidad], ...]]
  const plan = [
    [5001, 1001, 40, [[3, 1], [13, 2]]],
    [5002, 1003, 33, [[7, 1]]],
    [5003, 1004, 27, [[10, 3], [11, 2]]],
    [5004, 1005, 19, [[19, 1], [22, 1]]],
    [5005, 1001, 12, [[1, 1], [24, 1]]],
    [5006, 1006, 8, [[16, 2], [18, 1]]],
    [5007, 1007, 3, [[8, 1], [14, 1]]],
    [5008, 1003, 1, [[23, 2]]],
  ];
  const ventas = plan.map(([codigo, usuarioCodigo, dias, items]) => {
    const detalle = items.map(([productoCodigo, cantidad]) => {
      const p = productos.find((x) => x.codigo === productoCodigo);
      return { producto: productoCodigo, nombre: p.nombre, cantidad, precio: p.precio, subtotal: p.precio * cantidad };
    });
    return { codigo, fecha: fecha(dias), usuario: usuarioCodigo, items: detalle, total: detalle.reduce((s, i) => s + i.subtotal, 0) };
  });
  return { usuarios, productos, ventas };
}

let state = null;

const persist = () => {
  try {
    localStorage.setItem(KEY, JSON.stringify(state));
  } catch {
    /* modo privado o cuota llena: la demo sigue en memoria */
  }
};

async function init() {
  try {
    const raw = localStorage.getItem(KEY);
    if (raw) {
      state = JSON.parse(raw);
      return;
    }
  } catch {
    /* se vuelve a sembrar */
  }
  state = await buildSeed();
  persist();
}

export const ready = init();

export const resetDemo = () => {
  [KEY, SESSION_KEY, CART_KEY].forEach((k) => localStorage.removeItem(k));
};

// ---------- utilidades ----------
const nextCode = (table, base) => Math.max(base, ...state[table].map((r) => r.codigo)) + 1;
const clone = (v) => JSON.parse(JSON.stringify(v));
const safeUser = ({ passHash, ...u }) => u; // el hash nunca sale de aquí

// ---------- usuarios ----------
export const usuarios = {
  list: () => state.usuarios.map(safeUser),
  get: (codigo) => {
    const u = state.usuarios.find((x) => x.codigo === Number(codigo));
    return u ? safeUser(u) : null;
  },
  async create({ password, ...data }) {
    if (!data.nombre?.trim() || !data.correo?.trim() || !data.usuario?.trim()) throw new Error("Nombre, correo y usuario son obligatorios.");
    if (!/^\S+@\S+\.\S+$/.test(data.correo)) throw new Error("El correo no es válido.");
    if (!password || password.length < 6) throw new Error("La contraseña debe tener al menos 6 caracteres.");
    if (state.usuarios.some((u) => u.correo.toLowerCase() === data.correo.toLowerCase())) throw new Error("Este correo ya está registrado, intenta con otro.");
    if (state.usuarios.some((u) => u.usuario.toLowerCase() === data.usuario.toLowerCase())) throw new Error("Este nombre de usuario ya está registrado, intenta con otro.");
    const user = { rol: 2, ...data, codigo: nextCode("usuarios", 1000), passHash: await sha256(password) };
    state.usuarios.push(user);
    persist();
    return safeUser(user);
  },
  async update(codigo, { password, ...data }) {
    const u = state.usuarios.find((x) => x.codigo === Number(codigo));
    if (!u) throw new Error("El usuario no existe.");
    const dup = (f) => state.usuarios.some((o) => o.codigo !== u.codigo && o[f].toLowerCase() === String(data[f] ?? u[f]).toLowerCase());
    if (dup("correo")) throw new Error("Ese correo ya pertenece a otro usuario.");
    if (dup("usuario")) throw new Error("Ese nombre de usuario ya pertenece a otro usuario.");
    Object.assign(u, data);
    if (password) {
      if (password.length < 6) throw new Error("La contraseña debe tener al menos 6 caracteres.");
      u.passHash = await sha256(password);
    }
    persist();
    return safeUser(u);
  },
  remove(codigo) {
    const n = Number(codigo);
    if (state.ventas.some((v) => v.usuario === n)) throw new Error("No se puede eliminar: el usuario tiene ventas registradas.");
    state.usuarios = state.usuarios.filter((u) => u.codigo !== n);
    persist();
  },
};

// ---------- sesión ----------
export const auth = {
  async login(correo, password) {
    const hash = await sha256(password);
    const u = state.usuarios.find((x) => x.correo.toLowerCase() === correo.trim().toLowerCase() && x.passHash === hash);
    if (!u) throw new Error("Usuario o contraseña incorrectos.");
    localStorage.setItem(SESSION_KEY, String(u.codigo));
    return safeUser(u);
  },
  register: (data) => usuarios.create({ ...data, rol: 2 }),
  logout: () => localStorage.removeItem(SESSION_KEY),
  current() {
    const codigo = Number(localStorage.getItem(SESSION_KEY));
    return codigo ? usuarios.get(codigo) : null;
  },
};

// ---------- productos ----------
export const productos = {
  list: () => clone(state.productos),
  byCategoria: (c) => clone(state.productos.filter((p) => p.categoria === c)),
  ofertas: () => clone(state.productos.filter((p) => p.oferta)),
  get: (codigo) => clone(state.productos.find((p) => p.codigo === Number(codigo)) || null),
  create(data) {
    validarProducto(data);
    const p = { oferta: false, img: "logo.png", ...data, codigo: nextCode("productos", 0) };
    state.productos.push(p);
    persist();
    return clone(p);
  },
  update(codigo, data) {
    const p = state.productos.find((x) => x.codigo === Number(codigo));
    if (!p) throw new Error("El producto no existe.");
    validarProducto({ ...p, ...data });
    Object.assign(p, data);
    persist();
    return clone(p);
  },
  remove(codigo) {
    const n = Number(codigo);
    if (state.ventas.some((v) => v.items.some((i) => i.producto === n))) throw new Error("No se puede eliminar: el producto aparece en ventas registradas.");
    state.productos = state.productos.filter((p) => p.codigo !== n);
    persist();
  },
};

function validarProducto(p) {
  if (!p.nombre?.trim()) throw new Error("El nombre es obligatorio.");
  if (!(Number(p.precio) >= 0)) throw new Error("El precio no es válido.");
  if (!(Number.isInteger(Number(p.stock)) && Number(p.stock) >= 0)) throw new Error("El stock debe ser un entero mayor o igual a 0.");
}

// ---------- ventas ----------
export const ventas = {
  list: () => clone(state.ventas).sort((a, b) => b.codigo - a.codigo),
  byUsuario: (codigo) => ventas.list().filter((v) => v.usuario === Number(codigo)),
  // Crea la venta y descuenta stock de forma atómica (todo o nada).
  create(usuarioCodigo, lineas) {
    if (!lineas.length) throw new Error("El carrito está vacío.");
    const detalle = lineas.map(({ producto, cantidad }) => {
      const p = state.productos.find((x) => x.codigo === producto);
      if (!p) throw new Error("Un producto del carrito ya no existe.");
      if (cantidad > p.stock) throw new Error(`Stock insuficiente de «${p.nombre}» (quedan ${p.stock}).`);
      return { producto, nombre: p.nombre, cantidad, precio: p.precio, subtotal: p.precio * cantidad };
    });
    detalle.forEach((d) => {
      state.productos.find((x) => x.codigo === d.producto).stock -= d.cantidad;
    });
    const venta = { codigo: nextCode("ventas", 5000), fecha: new Date().toISOString(), usuario: Number(usuarioCodigo), items: detalle, total: detalle.reduce((s, i) => s + i.subtotal, 0) };
    state.ventas.push(venta);
    persist();
    return clone(venta);
  },
};

// ---------- carrito ----------
const readCart = () => {
  try {
    return JSON.parse(localStorage.getItem(CART_KEY)) || [];
  } catch {
    return [];
  }
};
const writeCart = (c) => localStorage.setItem(CART_KEY, JSON.stringify(c));

export const cart = {
  items: readCart,
  count: () => readCart().reduce((s, i) => s + i.cantidad, 0),
  add(producto, cantidad = 1) {
    const p = state.productos.find((x) => x.codigo === Number(producto));
    if (!p) throw new Error("El producto no existe.");
    const c = readCart();
    const line = c.find((i) => i.producto === p.codigo);
    const nueva = (line?.cantidad || 0) + cantidad;
    if (nueva > p.stock) throw new Error(`Solo quedan ${p.stock} unidades de «${p.nombre}».`);
    if (line) line.cantidad = nueva;
    else c.push({ producto: p.codigo, cantidad });
    writeCart(c);
  },
  setQty(producto, cantidad) {
    const p = state.productos.find((x) => x.codigo === Number(producto));
    const c = readCart().filter((i) => i.producto !== Number(producto) || cantidad > 0);
    const line = c.find((i) => i.producto === Number(producto));
    if (line) {
      if (cantidad > p.stock) throw new Error(`Solo quedan ${p.stock} unidades de «${p.nombre}».`);
      line.cantidad = cantidad;
    }
    writeCart(c);
  },
  clear: () => writeCart([]),
};
