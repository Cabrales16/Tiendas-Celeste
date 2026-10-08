// Tarjetas de producto + modal de detalle + "agregar al carrito" (compartido por portada y categorías).
import { cart, productos } from "./db.js";
import { esc, money, img, toast, updateCartBadge } from "./ui.js";

export function productCard(p) {
  const agotado = p.stock <= 0;
  return `
    <div class="card">
      <img src="${img(p.img)}" class="card-img-top" alt="${esc(p.nombre)}" style="height:500px;object-fit:cover">
      <div class="card-body d-flex flex-column">
        <h5 class="card-title">${esc(p.nombre)}</h5>
        <p class="card-text">${esc(p.descripcion)}</p>
        <p class="precio mt-auto mb-2">${money(p.precio)} ${agotado ? '<span class="badge text-bg-secondary">Agotado</span>' : `<small class="text-muted">· ${p.stock} disponibles</small>`}</p>
        <div class="d-flex gap-2">
          <button class="btn btn-outline-primary btn-ver" data-codigo="${p.codigo}">Ver el producto</button>
          <button class="btn btn-primary btn-add" data-codigo="${p.codigo}" ${agotado ? "disabled" : ""}>Agregar al carrito</button>
        </div>
      </div>
    </div>`;
}

function ensureModal() {
  let el = document.getElementById("productModal");
  if (el) return el;
  el = document.createElement("div");
  el.id = "productModal";
  el.className = "modal fade";
  el.tabIndex = -1;
  el.innerHTML = `<div class="modal-dialog modal-lg modal-dialog-centered"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title"></h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div>
    <div class="modal-body"></div>
    <div class="modal-footer"></div></div></div>`;
  document.body.appendChild(el);
  return el;
}

function openProduct(codigo) {
  const p = productos.get(codigo);
  if (!p) return;
  const el = ensureModal();
  el.querySelector(".modal-title").textContent = p.nombre;
  el.querySelector(".modal-body").innerHTML = `
    <div class="row g-3">
      <div class="col-md-6"><img src="${img(p.img)}" alt="${esc(p.nombre)}" class="img-fluid rounded"></div>
      <div class="col-md-6">
        <p>${esc(p.descripcion)}</p>
        <p class="precio fs-4">${money(p.precio)}</p>
        <p class="text-muted">${p.stock > 0 ? `${p.stock} unidades disponibles` : "Producto agotado"}</p>
      </div>
    </div>`;
  const wa = `https://wa.me/573232459309?text=${encodeURIComponent(`Hola, me interesa: ${p.nombre} (${money(p.precio)})`)}`;
  el.querySelector(".modal-footer").innerHTML = `
    <a class="btn btn-success" href="${wa}" target="_blank" rel="noopener noreferrer">Preguntar por WhatsApp</a>
    <button class="btn btn-primary" id="modal-add" ${p.stock <= 0 ? "disabled" : ""}>Agregar al carrito</button>`;
  el.querySelector("#modal-add").addEventListener("click", () => {
    addToCart(p.codigo);
    bootstrap.Modal.getInstance(el).hide();
  });
  bootstrap.Modal.getOrCreateInstance(el).show();
}

export function addToCart(codigo) {
  try {
    cart.add(codigo, 1);
    updateCartBadge();
    toast("Producto agregado al carrito 🛒");
  } catch (e) {
    toast(e.message, "error");
  }
}

// Delegación de eventos sobre un contenedor con tarjetas.
export function bindCards(container) {
  container.addEventListener("click", (e) => {
    const ver = e.target.closest(".btn-ver");
    const add = e.target.closest(".btn-add");
    if (ver) openProduct(ver.dataset.codigo);
    if (add) addToCart(add.dataset.codigo);
  });
}
