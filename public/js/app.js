// función para mostrar barra
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('open');
}

// funcion modo oscuro
function toggleMode() {
    const body = document.body;
    const button = document.getElementById("modeToggle");

    // alterna la clase 'dark-mode' en el body
    body.classList.toggle("dark-mode");

    // verifica el estado y actualizar el almacenamiento y el botón
    if (body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
        button.innerHTML = "☀️ Modo Claro";  // cambia el texto
    } else {
        localStorage.setItem('darkMode', 'disabled');
        button.innerHTML = "🌙 Modo Oscuro";  // cambia text
    }
}

// aplicar el modo oscuro al cargar la página si está habilitado en localStorage
window.addEventListener('DOMContentLoaded', () => {
    const darkMode = localStorage.getItem('darkMode');
    const button = document.getElementById("modeToggle");

    if (darkMode === 'enabled') {
        document.body.classList.add('dark-mode');
        button.innerHTML = "☀️ Modo Claro";  // muestra modo claro
    } else {
        button.innerHTML = "🌙 Modo Oscuro";  // muestra modooscuro
    }
});

// agregar el evento de clic al botón de modo oscuro
// document.getElementById('modeToggle').addEventListener('click', toggleMode);

// mensajes
function showToast(message) {
    const toastMessage = document.getElementById('toastMessage');
    toastMessage.textContent = message;
    
    const toastElement = new bootstrap.Toast(document.getElementById('liveToast'));
    toastElement.show();
}
