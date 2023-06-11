// Al cargar la página, verifica si hay información guardada en el almacenamiento local y recupérala
window.addEventListener("load", () => {
  if (localStorage.getItem("carrito")) {
    carrito = JSON.parse(localStorage.getItem("carrito"));
    mostrarCarrito();
  }
});

// Función para guardar el carrito de compras en el almacenamiento local
function guardarCarrito() {
  localStorage.setItem("carrito", JSON.stringify(carrito));
}

// Obtén todos los botones de "Añadir"
const botonesAgregar = document.querySelectorAll(".boton-producto");
const feedback = document.querySelectorAll("#feedback-c");

// Inicializa el carrito de compras como un array vacío
let carrito = [];
let total = 0;
document.getElementById("feedback-c").innerHTML = carrito.length;

botonesAgregar.forEach((boton) => {
  boton.addEventListener("click", () => {
    // Obtén el producto correspondiente al botón de "Añadir"
    const producto = boton.parentElement;
    const nombre = producto.querySelector("h2").innerText;
    const talla = producto.querySelector('select[name="talla"]').value;
    const precio = producto.querySelector(".precio").innerText;
    const id = producto.querySelector('.product-id').value;

    // Agrega el producto al carrito de compras
    carrito.push({ id, nombre, talla, precio });

    total = parseFloat(total) + parseFloat(precio);

    // Actualiza el contenido del carrito de compras
    mostrarCarrito();
    document.getElementById("feedback-c").innerHTML = carrito.length;
    document.getElementById("total").innerHTML = total;

    guardarCarrito();
  });
});

function mostrarCarrito() {
  const carritoDiv = document.getElementById("carrito");
  carritoDiv.innerHTML = "";

  // Recorre cada producto en el carrito
  carrito.forEach((producto, index) => {
    // Crea el elemento carritoProducto
    const carritoProducto = document.createElement("div");
    carritoProducto.classList.add("carrito-producto");

    // Crea y configura los elementos internos de carritoProducto
    const productoDiv = document.createElement("span");
    const precioDiv = document.createElement("p");
    const equis = document.createElement("button");
    equis.innerText = "✖"; // Símbolo de equis (✖)

    productoDiv.innerText = `${producto.nombre} (Talla: ${producto.talla})`;
    precioDiv.innerText = `€ ${producto.precio}`;
    precioDiv.appendChild(equis);

    // Agrega el evento onClick al botón equis
    equis.addEventListener("click", () => {
      // Elimina el producto del carrito
      carrito.splice(index, 1);
      // Vuelve a mostrar el carrito actualizado
      mostrarCarrito();
      guardarCarrito();
    });

    // Establece el atributo de datos 'data-product-id' con el ID del producto
    carritoProducto.setAttribute("data-product-id", `${producto.id}`);

    // Agrega los elementos al carritoProducto
    carritoProducto.appendChild(productoDiv);
    carritoProducto.appendChild(precioDiv);

    // Agrega el carritoProducto al carritoDiv
    carritoDiv.appendChild(carritoProducto);
  });

  // Actualiza la longitud del carrito y el total a pagar
  document.getElementById("feedback-c").innerHTML = carrito.length;
  calcularTotal();
}

// Función para calcular el total a pagar
function calcularTotal() {
  total = 0;
  carrito.forEach((producto) => {
    total += Number(producto.precio);
  });

  // Actualiza el total en el DOM
  document.getElementById("total").innerHTML = `€ ${total}`;

  guardarCarrito();
}

// Abrir carrito de compras
document.addEventListener("DOMContentLoaded", () => {
  const abrirModal = document.querySelector("#icono-carrito");
  const cerrarModal = document.querySelector(".close");
  const modal = document.querySelector(".modal-general");

  abrirModal.addEventListener("click", () => {
    modal.showModal();
  });
  cerrarModal.addEventListener("click", () => {
    modal.close();
  });
});

// Abrir pop-up para iniciar sesión
const abrirModal = document.querySelector("#mi-cuenta");
const cerrarModal = document.querySelector("#cerrar-ventana");
const modal = document.querySelector("#modal");

abrirModal.addEventListener("click", () => {
  modal.showModal();
});

cerrarModal.addEventListener("click", () => {
  modal.close();
});

let productCard = document.querySelector(".producto img");
productCard.addEventListener("click", function () {
  console.log("hola");
});

function abrirRegistro() {
  window.open("registro.html");
}

function abrir_modal() {
  const cerrar_modal = document.querySelector(".modal-general");
  cerrar_modal.close;
  const modal = document.getElementById("modal");
  modal.showModal;
}
