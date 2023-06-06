// Menú hamburguesa
const navbarToggle = document.querySelector('.navbar-toggle');
const navbarList = document.querySelector('.nav-list');

navbarToggle.addEventListener('click', () => {
    navbarToggle.classList.toggle('active');
    navbarList.classList.toggle('active');
});

// Botones popup de cookies
const popupOk = document.querySelector('.popup-ok');
const popupInfo = document.querySelector('.popup-info');
const popup = document.querySelector('.popup');
popupOk.addEventListener('click', ()=> {
    popup.style.display = 'none';
});
popupInfo.addEventListener('click', ()=> {
    window.open("cookies/cookies.html", "_blank");
});

// Crear una cookie
function setCookie(name, value, expirationDays) {
    const date = new Date();
    date.setTime(date.getTime() + (expirationDays * 24 * 60 * 60 * 1000)); // Convertir días a milisegundos
    
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// Obtener el valor de una cookie
function getCookie(name) {
    const cookieName = name + "=";
    const cookies = document.cookie.split(';');
    
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(cookieName) === 0) {
            return cookie.substring(cookieName.length, cookie.length);
        }
    }
    return "";
} 

// Ejemplo de uso
setCookie("preferencias", "español", 30); // Crear una cookie llamada "preferencias" con el valor "español" que expira en 30 días

const preferencias = getCookie("preferencias"); // Obtener el valor de la cookie "preferencias"

console.log(preferencias); // Mostrar el valor de la cookie en la consola

// funcion para el login
function login() {
    let usuario = document.getElementById("usuario").value;
    let contrasenia = document.getElementById("contrasenia").value;

    if (usuario == "joaquin" && contrasenia == "hola") {
        window.open("interfaz.php");
    } else {
        alert("usuario no reconocido");
    }
}

