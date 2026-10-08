// Panel de empleados: CRUD de usuarios y productos, listado de ventas y reportes PDF.
import { boot, esc, money, fechaCorta, toast } from "./ui.js";
import { usuarios, productos, ventas, ROLES } from "./db.js";
import { CATEGORIAS } from "./catalogo.js";

const me = await boot({ requireRole: 1 });
if (!me) await new Promise(() => {}); // redirigiendo: se detiene la carga del módulo

const view = document.getElementById("view");
const modalEl = document.getElementById("formModal");
const modal = new bootstrap.Modal(modalEl);
const form = document.getElementById("modalForm");
let tab = "usuarios";
let busqueda = "";
let onSubmit = null;

const catName = (k) => (CATEGORIAS[k] || k).replace(/[^\p{L}\p{N} ]/gu, "").trim();

// ---------- modal ----------
function openModal({ title, body, submitLabel = "Guardar", submit }) {
  document.getElementById("modalTitle").textContent = title;
  document.getElementById("modalBody").innerHTML = body;
  document.getElementById("modalFooter").innerHTML = `
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    ${submit ? `<button class="btn btn-primary">${submitLabel}</button>` : ""}`;
  onSubmit = submit;
  modal.show();
}

form.addEventListener("submit", async (e) => {
  e.preventDefault();
  if (!onSubmit) return;
  try {
    await onSubmit(Object.fromEntries(new FormData(form)));
    modal.hide();
    render();
  } catch (err) {
    toast(err.message, "error");
  }
});

const field = (label, name, value = "", attrs = "") =>
  `<div class="col-md-6"><label class="form-label">${label}</label><input class="form-control" name="${name}" value="${esc(value)}" ${attrs}></div>`;

// ---------- usuarios ----------
function viewUsuarios() {
  const q = busqueda.trim().toLowerCase();
  const list = usuarios.list().filter((u) => !q || String(u.codigo).startsWith(q) || `${u.nombre} ${u.apellido ?? ""} ${u.correo}`.toLowerCase().includes(q));
  view.innerHTML = `
    <div class="d-flex flex-wrap gap-2 mb-3">
      <input id="search" class="form-control" style="max-width:320px" placeholder="🔎 Buscar por código, nombre o correo" value="${esc(busqueda)}">
      <button class="btn btn-primary ms-auto" id="add">+ Agregar usuario</button>
      <button class="btn btn-outline-secondary" id="pdf">Generar reporte PDF</button>
    </div>
    <div class="table-responsive"><table class="table table-hover bg-white">
      <thead class="table-light"><tr><th>Código</th><th>Nombre</th><th>Usuario</th><th>Correo</th><th>Rol</th><th class="text-end">Acciones</th></tr></thead>
      <tbody>${list.map((u) => `
        <tr>
          <td>${u.codigo}</td><td>${esc(u.nombre)} ${esc(u.apellido)}</td><td>${esc(u.usuario)}</td><td>${esc(u.correo)}</td>
          <td><span class="badge text-bg-${u.rol === 1 ? "primary" : "secondary"}">${ROLES[u.rol] || "—"}</span></td>
          <td class="text-end">
            <button class="btn btn-sm btn-outline-primary" data-edit="${u.codigo}">Modificar</button>
            <button class="btn btn-sm btn-outline-danger" data-del="${u.codigo}" ${u.codigo === me.codigo ? "disabled title='No puedes eliminarte a ti mismo'" : ""}>Eliminar</button>
          </td>
        </tr>`).join("") || `<tr><td colspan="6" class="text-center text-muted">Sin resultados</td></tr>`}</tbody>
    </table></div>`;

  const search = document.getElementById("search");
  search.addEventListener("input", () => {
    busqueda = search.value;
    viewUsuarios();
    const s = document.getElementById("search");
    s.focus();
    s.setSelectionRange(s.value.length, s.value.length);
  });
  document.getElementById("add").onclick = () => userForm();
  document.getElementById("pdf").onclick = pdfUsuarios;
  view.querySelectorAll("[data-edit]").forEach((b) => (b.onclick = () => userForm(usuarios.get(b.dataset.edit))));
  view.querySelectorAll("[data-del]").forEach((b) => (b.onclick = () => {
    const u = usuarios.get(b.dataset.del);
    if (!confirm(`¿Estás seguro de eliminar a ${u.nombre}?`)) return;
    try {
      usuarios.remove(u.codigo);
      toast("Usuario eliminado");
    } catch (err) {
      toast(err.message, "error");
    }
    render();
  }));
}

function userForm(u) {
  const editing = !!u;
  openModal({
    title: editing ? `Modificar usuario #${u.codigo}` : "Nuevo usuario",
    body: `<div class="row g-3">
      ${field("Nombre", "nombre", u?.nombre, "required")}
      ${field("Apellido", "apellido", u?.apellido)}
      ${field("Usuario", "usuario", u?.usuario, "required")}
      ${field("Correo", "correo", u?.correo, 'type="email" required')}
      ${field(editing ? "Nueva contraseña (opcional)" : "Contraseña", "password", "", `type="password" autocomplete="new-password" ${editing ? "" : "required"}`)}
      <div class="col-md-6"><label class="form-label">Rol</label>
        <select class="form-select" name="rol">${Object.entries(ROLES).map(([k, v]) => `<option value="${k}" ${Number(u?.rol ?? 2) === Number(k) ? "selected" : ""}>${v}</option>`).join("")}</select></div>
      ${field("Celular", "celular", u?.celular)}
      ${field("Dirección", "direccion", u?.direccion)}
    </div>`,
    submit: async (f) => {
      const data = { ...f, rol: Number(f.rol) };
      if (editing) {
        if (u.codigo === me.codigo && data.rol !== 1) throw new Error("No puedes quitarte tu propio rol de empleado.");
        await usuarios.update(u.codigo, data);
      } else await usuarios.create(data);
      toast(editing ? "Usuario modificado" : "Usuario creado");
    },
  });
}

// ---------- productos ----------
function viewProductos() {
  view.innerHTML = `
    <div class="d-flex mb-3"><button class="btn btn-primary ms-auto" id="add">+ Agregar producto</button></div>
    <div class="table-responsive"><table class="table table-hover bg-white">
      <thead class="table-light"><tr><th>Código</th><th>Producto</th><th>Categoría</th><th>Precio</th><th>Stock</th><th class="text-end">Acciones</th></tr></thead>
      <tbody>${productos.list().map((p) => `
        <tr>
          <td>${p.codigo}</td>
          <td><img src="../assets/images/${esc(p.img)}" alt="" style="width:40px;height:40px;object-fit:cover;border-radius:4px" class="me-2">${esc(p.nombre)} ${p.oferta ? '<span class="badge text-bg-warning">Oferta</span>' : ""}</td>
          <td>${esc(catName(p.categoria))}</td><td>${money(p.precio)}</td>
          <td>${p.stock <= 5 ? `<span class="text-danger fw-bold">${p.stock}</span>` : p.stock}</td>
          <td class="text-end">
            <button class="btn btn-sm btn-outline-primary" data-edit="${p.codigo}">Modificar</button>
            <button class="btn btn-sm btn-outline-danger" data-del="${p.codigo}">Eliminar</button>
          </td>
        </tr>`).join("")}</tbody>
    </table></div>`;
  document.getElementById("add").onclick = () => productForm();
  view.querySelectorAll("[data-edit]").forEach((b) => (b.onclick = () => productForm(productos.get(b.dataset.edit))));
  view.querySelectorAll("[data-del]").forEach((b) => (b.onclick = () => {
    const p = productos.get(b.dataset.del);
    if (!confirm(`¿Eliminar «${p.nombre}»?`)) return;
    try {
      productos.remove(p.codigo);
      toast("Producto eliminado");
    } catch (err) {
      toast(err.message, "error");
    }
    render();
  }));
}

function productForm(p) {
  const editing = !!p;
  openModal({
    title: editing ? `Modificar producto #${p.codigo}` : "Nuevo producto",
    body: `<div class="row g-3">
      ${field("Nombre", "nombre", p?.nombre, "required")}
      <div class="col-md-6"><label class="form-label">Categoría</label>
        <select class="form-select" name="categoria">${Object.keys(CATEGORIAS).map((k) => `<option value="${k}" ${p?.categoria === k ? "selected" : ""}>${esc(catName(k))}</option>`).join("")}</select></div>
      ${field("Precio (COP)", "precio", p?.precio ?? "", 'type="number" min="0" step="100" required')}
      ${field("Stock", "stock", p?.stock ?? "", 'type="number" min="0" step="1" required')}
      <div class="col-12"><label class="form-label">Descripción</label><textarea class="form-control" name="descripcion" rows="3">${esc(p?.descripcion)}</textarea></div>
      <div class="col-12 form-check ms-2"><input class="form-check-input" type="checkbox" name="oferta" id="oferta" ${p?.oferta ? "checked" : ""}><label class="form-check-label" for="oferta">Mostrar en la portada como oferta</label></div>
    </div>`,
    submit: (f) => {
      const data = { ...f, precio: Number(f.precio), stock: Number(f.stock), oferta: f.oferta === "on" };
      if (editing) productos.update(p.codigo, data);
      else productos.create(data);
      toast(editing ? "Producto modificado" : "Producto creado");
    },
  });
}

// ---------- ventas ----------
function viewVentas() {
  const nombres = Object.fromEntries(usuarios.list().map((u) => [u.codigo, `${u.nombre} ${u.apellido ?? ""}`.trim()]));
  const list = ventas.list();
  view.innerHTML = `
    <div class="d-flex mb-3"><span class="text-muted align-self-center">Total vendido: <strong>${money(list.reduce((s, v) => s + v.total, 0))}</strong> en ${list.length} ventas</span>
      <button class="btn btn-outline-secondary ms-auto" id="pdf">Generar reporte PDF</button></div>
    <div class="table-responsive"><table class="table table-hover bg-white">
      <thead class="table-light"><tr><th>#</th><th>Fecha</th><th>Cliente</th><th>Productos</th><th>Total</th><th></th></tr></thead>
      <tbody>${list.map((v) => `
        <tr><td>${v.codigo}</td><td>${fechaCorta(v.fecha)}</td><td>${esc(nombres[v.usuario] || "Usuario eliminado")}</td>
          <td>${v.items.reduce((s, i) => s + i.cantidad, 0)}</td><td>${money(v.total)}</td>
          <td class="text-end"><button class="btn btn-sm btn-outline-primary" data-det="${v.codigo}">Ver detalle</button></td></tr>`).join("")}</tbody>
    </table></div>`;
  document.getElementById("pdf").onclick = () => pdfVentas(list, nombres);
  view.querySelectorAll("[data-det]").forEach((b) => (b.onclick = () => {
    const v = list.find((x) => x.codigo === Number(b.dataset.det));
    openModal({
      title: `Venta #${v.codigo} · ${fechaCorta(v.fecha)}`,
      body: `<p><strong>Cliente:</strong> ${esc(nombres[v.usuario] || "—")}</p>
        <table class="table table-sm"><thead><tr><th>Producto</th><th>Cant.</th><th>Precio</th><th>Subtotal</th></tr></thead>
        <tbody>${v.items.map((i) => `<tr><td>${esc(i.nombre)}</td><td>${i.cantidad}</td><td>${money(i.precio)}</td><td>${money(i.subtotal)}</td></tr>`).join("")}</tbody>
        <tfoot><tr><th colspan="3" class="text-end">Total</th><th>${money(v.total)}</th></tr></tfoot></table>`,
    });
  }));
}

// ---------- PDF (reemplaza a FPDF) ----------
function makePdf(titulo, head, body, widths) {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF({ orientation: "landscape" });
  doc.setFontSize(20);
  doc.text(titulo, doc.internal.pageSize.getWidth() / 2, 18, { align: "center" });
  doc.autoTable({
    head: [head],
    body,
    startY: 28,
    theme: "grid",
    headStyles: { fillColor: [168, 255, 158], textColor: 0 },
    columnStyles: widths,
    didDrawPage: () => {
      doc.setFontSize(8);
      doc.text(`Página ${doc.internal.getNumberOfPages()}`, doc.internal.pageSize.getWidth() / 2, doc.internal.pageSize.getHeight() - 8, { align: "center" });
    },
  });
  return doc;
}

// A diferencia del reporte original, no incluye contraseñas.
function pdfUsuarios() {
  const rows = usuarios.list().map((u, i) => [i + 1, u.codigo, `${u.nombre} ${u.apellido ?? ""}`.trim(), u.usuario, u.correo, ROLES[u.rol] || "—"]);
  makePdf("Reporte de Usuarios", ["No", "Código", "Nombre", "Usuario", "Correo", "Rol"], rows, {}).save("Reporte_Usuarios.pdf");
}

function pdfVentas(list, nombres) {
  const rows = list.map((v) => [v.codigo, fechaCorta(v.fecha), nombres[v.usuario] || "—", v.items.map((i) => `${i.cantidad} x ${i.nombre}`).join(", "), money(v.total)]);
  makePdf("Reporte de Ventas", ["#", "Fecha", "Cliente", "Productos", "Total"], rows, { 3: { cellWidth: 100 } }).save("Reporte_Ventas.pdf");
}

// ---------- navegación ----------
function render() {
  document.querySelectorAll("#tabs .nav-link").forEach((b) => b.classList.toggle("active", b.dataset.tab === tab));
  ({ usuarios: viewUsuarios, productos: viewProductos, ventas: viewVentas })[tab]();
}

document.getElementById("tabs").addEventListener("click", (e) => {
  const b = e.target.closest("[data-tab]");
  if (!b) return;
  tab = b.dataset.tab;
  render();
});

render();
