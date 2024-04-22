console.log("cargado index");

// Carga el script user.js utilizando la etiqueta <script>
var script = document.createElement('script');
script.src = './user.js';
document.head.appendChild(script);

$(document).ready(function() {

    var url = document.getElementById('data').dataset.url;

    $('#tableUsers').DataTable({
        "paging": true, // Habilitar paginación
        "processing": true,
        "serverSide": true, // Habilitar el modo de procesamiento del lado del servidor
        "ajax": {
            url: url,
            type: 'GET',
        },
        "columns": dameColumnas(), // Llama a la función dameColumnas para obtener las columnas
        "language": {
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered": "(filtrado de _MAX_ entradas totales)"
        }
    });

    // Evento para aplicar los filtros en los campos de búsqueda
    $('.searchField').on('keyup change', function () {
        table.draw(); // Volver a dibujar la tabla con los nuevos filtros
    });

    // Evento clic para el botón de editar
    $('#tableUsers').on('click', '.editBtn', function () {
        var noteId = $(this).data('id');
        // Aquí puedes redirigir a la página de edición de la nota
        console.log(noteId);
        window.location.href = '/notas/' + noteId + '/editar';
    });

    // Evento clic para el botón de eliminar
    $('#tableUsers').on('click', '.deleteBtn', function () {
        var noteId = $(this).data('id');

        if (confirm('¿Estás seguro de que deseas eliminar esta nota?')) {
            $.ajax({
                url: '/notas/' + noteId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log("Success: ", result);
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.log("Error: ", error);
                    table.ajax.reload();
                }

            });
        }
    });

    $('#tableNotas').DataTable({
        "paging": true, // Habilitar paginación
        "processing": true,
        "serverSide": true, // Habilitar el modo de procesamiento del lado del servidor
        "ajax": {
            url: url,
            type: 'GET',
            data: function (d) {
                // Aquí se obtiene el valor de los campos de búsqueda dentro del contenedor de filtros
                d.search = {
                    title: $('#searchField_1').val(), // Valor de búsqueda para el título
                    content: $('#searchField_2').val(), // Valor de búsqueda para el contenido
                    time: $('#searchField_3').val(), // Valor de búsqueda para la fecha
                };
            }
        },
        "columns": [
            { "data": "title", "searchable": true },
            { "data": "content", "searchable": true },
            { "data": "time", "searchable": true },
            // Aquí puedes agregar más columnas si es necesario
            {
                "data": null,
                "render": function (data, type, row) {
                    // Aquí se genera el HTML para los botones de editar y eliminar
                    return '<button class="editBtn" data-id="' + data.id + '">Edit</button>' +
                        '<button class="deleteBtn" data-id="' + data.id + '">Delete</button>';
                }
            }
        ],
        "searching": false, // Habilitar la funcionalidad de búsqueda
        "lengthChange": true, // Desactivar la opción de cambiar la cantidad de entradas mostradas
        "language": {
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
            "infoEmpty": "Mostrando 0 a 0 de 0 entradas",
            "infoFiltered": "(filtrado de _MAX_ entradas totales)"
        }
    });

    // Evento para aplicar los filtros en los campos de búsqueda
    $('.searchField').on('keyup change', function () {
        table.draw(); // Volver a dibujar la tabla con los nuevos filtros
    });

    // Evento clic para el botón de editar
    $('#tableNotas').on('click', '.editBtn', function () {
        var noteId = $(this).data('id');
        // Aquí puedes redirigir a la página de edición de la nota
        console.log(noteId);
        window.location.href = '/notas/' + noteId + '/editar';
    });

    // Evento clic para el botón de eliminar
    $('#tableNotas').on('click', '.deleteBtn', function () {
        var noteId = $(this).data('id');

        if (confirm('¿Estás seguro de que deseas eliminar esta nota?')) {
            $.ajax({
                url: '/notas/' + noteId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result) {
                    console.log("Success: ", result);
                    table.ajax.reload();
                },
                error: function(xhr, status, error) {
                    console.log("Error: ", error);
                    table.ajax.reload();
                }

            });
        }
    });
});
