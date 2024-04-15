<x-layout>
    {{--VITE Carga de archivos dinámicas--}}

    <main class="content">
        <table id="myTable" class="display">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- Aquí se agregarán las filas de la tabla con los datos de las notas --}}
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

     <script>
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                "paging": true, // Habilitar paginación
                "processing": true,
                "serverSide": true, // Habilitar el modo de procesamiento del lado del servidor
                "ajax": "{{ route('data.get') }}", // Ruta para obtener los datos del controlador
                "columns": [
                    { "data": "title" },
                    { "data": "content" },
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

// Obtener el número total de campos de búsqueda
            //var totalSearchFields = $('#myTable thead th').length;

// Aplicar un filtro para cada columna
            $('#myTable thead th').each(function (index) {
                var title = $(this).text();
                var uniqueId = 'searchField_' + index; // Generar un id único para cada campo de búsqueda
                $(this).html('<input type="search" id="' + uniqueId + '" class="searchField" placeholder="Search ' + title + '" aria-controls="myTable" />');
            });


            // Evento para aplicar los filtros
            table.columns().every(function () {
                var that = this;
                $('input', this.header()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
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
    </script>
</x-layout>
