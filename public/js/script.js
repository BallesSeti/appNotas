
console.log("script.js cargado");
filtroHeader = document.getElementById('filtro-header');

filtroHeader.addEventListener('click', () => {
    filtroHeader.classList.toggle('clicked');
});
