$(document).ready(function() {
    $('#myTable').DataTable({
        "ajax": "{{ route('data.get') }}", // Ruta para obtener los datos del controlador
        "columns": [
            { "data": "title" },
            { "data": "content" },
            // Definir columnas adicionales si es necesario
        ],
        "searching": false, // Desactivar la funcionalidad de búsqueda
        "lengthChange": false, // Desactivar la opción de cambiar la cantidad de entradas mostradas
        "pageLength": 5 // Establecer la cantidad predeterminada de entradas mostradas por página
    });
});
