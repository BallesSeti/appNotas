console.log("cargado index");
$(document).ready(function () {
    var table = $('#myTable').DataTable({
        "paging": true, // Habilitar paginación
        "processing": true,
        "serverSide": true, // Habilitar el modo de procesamiento del lado del servidor
        "ajax": {
            url: "{{ route('data.get') }}",
            type: 'GET',
            data: function (d) {
                // Aquí se obtiene el valor del campo de búsqueda específico dentro de la columna correspondiente

                //Se puede coger
                d.search = {
                    title: $('.searchField').eq(0).val(), // Valor de búsqueda para el título
                    content: $('.searchField').eq(1).val(), // Valor de búsqueda para el contenido
                    time: $('.searchField').eq(2).val(), // Valor de búsqueda para la fecha
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

    // Aplicar un filtro
    $('#myTable thead th').each(function (index) {

        if (index === 0 || index === 1) { // Agregar campo de búsqueda solo para la primera columna
            var title = $(this).text();
            var uniqueId = 'searchField_' + index; // Generar un id único para el campo de búsqueda
            $(this).html('<input type="search" id="' + uniqueId + '" class="searchField" placeholder="Search ' + title + '" aria-controls="myTable" />');
        }

        if (index === 2) { // Agregar campo de búsqueda solo para la primera columna
            var title = $(this).text();
            var uniqueId = 'searchField_' + index; // Generar un id único para el campo de búsqueda
            $(this).html('<input type="date" id="' + uniqueId + '" class="searchField" placeholder="Search ' + title + '" aria-controls="myTable" />');
        }

    });

    // Evento para aplicar los filtros solo en la primera columna
    table.column(0).every(function () {
        var that = this;
        $('input', this.header()).on('keyup change', function () {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
                console.log($('.searchField').val());
            }
        });
    });

    // Evento clic para el botón de editar
    $('#myTable').on('click', '.editBtn', function () {
        var noteId = $(this).data('id');
        // Aquí puedes redirigir a la página de edición de la nota
        console.log(noteId);
        window.location.href = '/notas/' + noteId + '/editar';
    });

    // Evento clic para el botón de eliminar
    $('#myTable').on('click', '.deleteBtn', function () {
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
