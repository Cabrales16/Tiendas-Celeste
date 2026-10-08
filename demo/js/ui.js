// Piezas de interfaz compartidas: navbar, footer, avisos y utilidades.
import { ready, auth, cart, resetDemo } from "./db.js";
import { CATEGORIAS } from "./catalogo.js";

export const esc = (s) =>
  String(s ?? "").replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));

export const money = (n) => new Intl.NumberFormat("es-CO", { style: "currency", currency: "COP", maximumFractionDigits: 0 }).format(n);
export const fechaCorta = (iso) => new Date(iso).toLocaleDateString("es-CO", { day: "2-digit", month: "short", year: "numeric" });
export const img = (name) => `../assets/images/${esc(name)}`;

export function toast(message, type = "success") {
  let box = document.getElementById("toasts");
  if (!box) {
    box = document.createElement("div");
    box.id = "toasts";
    document.body.appendChild(box);
  }
  const el = document.createElement("div");
  el.className = `tc-toast tc-toast-${type}`;
  el.textContent = message;
  box.appendChild(el);
  setTimeout(() => el.remove(), 3500);
}

export function renderNav() {
  const user = auth.current();
  const cats = Object.entries(CATEGORIAS)
    .map(([k, titulo]) => `<li><a class="dropdown-item" href="categoria.html?c=${k}">${esc(titulo.replace(/[^\p{L}\p{N} ]/gu, "").trim())}</a></li>`)
    .join("");
  const count = cart.count();
  document.getElementById("nav").innerHTML = `
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.html"><img src="../assets/images/logo.png" alt="Tiendas Celeste" style="height:50px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Menú">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="index.html#tituloinf">Quiénes somos</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Tienda</a>
              <ul class="dropdown-menu">${cats}</ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="carrito.html">🛒 Carrito <span id="cart-count" class="badge text-bg-primary ${count ? "" : "d-none"}">${count}</span></a></li>
            ${user?.rol === 1 ? `<li class="nav-item"><a class="nav-link" href="panel.html">Panel</a></li>` : ""}
          </ul>
          <ul class="navbar-nav">
            ${
              user
                ? `<li class="nav-item"><span class="navbar-text me-3">Hola, ${esc(user.nombre)}</span></li>
                   <li class="nav-item"><a class="nav-link" href="#" id="logout">Cerrar sesión</a></li>`
                : `<li class="nav-item"><a class="nav-link" href="login.html">Iniciar sesión</a></li>`
            }
          </ul>
        </div>
      </div>
    </nav>`;
  document.getElementById("logout")?.addEventListener("click", (e) => {
    e.preventDefault();
    auth.logout();
    location.href = "index.html";
  });
}

export const updateCartBadge = () => {
  const el = document.getElementById("cart-count");
  if (!el) return;
  const n = cart.count();
  el.textContent = n;
  el.classList.toggle("d-none", !n);
};

export function renderFooter() {
  const el = document.getElementById("footer");
  if (!el) return;
  el.innerHTML = `
    <h1><p id="tituloinf">Quiénes somos</p></h1>
    <ul id="lista">
      <li><em>Obsequios como caídos del cielo</em></li><br>
      <li>
        <a href="https://www.facebook.com/ObsequiosCeleste/" target="_blank" rel="noopener noreferrer"><img src="../assets/images/facebook.png" alt="Facebook" style="height:50px"></a>
        <a href="https://www.tiktok.com/@obsequiosceleste" target="_blank" rel="noopener noreferrer"><img src="../assets/images/tiktok.png" alt="TikTok" style="height:50px"></a>
        <a href="https://www.instagram.com/obsequiosceleste?igsh=MTQweG43aHo3bXRkNg==" target="_blank" rel="noopener noreferrer"><img src="../assets/images/instagram.png" alt="Instagram" style="height:50px"></a>
        @ObsequiosCeleste
      </li><br>
      <li><img src="../assets/images/whatsapp.png" alt="WhatsApp" style="height:50px"> 3232459309</li><br>
      <li>Centro comercial punto 72</li>
    </ul>`;
}

export function renderDemoBanner() {
  const el = document.createElement("div");
  el.className = "demo-banner";
  el.innerHTML = `<span>🧪 <span class="d-none d-sm-inline">Modo demo: los datos se guardan solo en tu navegador.</span><span class="d-sm-none">Modo demo</span></span>
    <button type="button" id="demo-reset">Restaurar datos</button>`;
  document.body.appendChild(el);
  el.querySelector("#demo-reset").addEventListener("click", () => {
    if (confirm("Se borrarán tus cambios y volverán los datos de ejemplo. ¿Continuar?")) {
      resetDemo();
      location.href = "index.html";
    }
  });
}

// Punto de entrada común de cada página: espera la BD y pinta navbar/footer.
export async function boot({ requireRole } = {}) {
  await ready;
  const user = auth.current();
  if (requireRole && user?.rol !== requireRole) {
    const next = encodeURIComponent(location.pathname.split("/").pop() + location.search);
    location.replace(user ? "index.html?denegado=1" : `login.html?next=${next}`);
    return null;
  }
  renderNav();
  renderFooter();
  renderDemoBanner();
  return user;
}
