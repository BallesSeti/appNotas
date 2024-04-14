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
        $(document).ready(function() {
            var table = $('#myTable').DataTable({
                "paging": true, // Habilitar paginación
                "serverSide": true, // Habilitar el modo de procesamiento del lado del servidor
                "ajax": "{{ route('data.get') }}", // Ruta para obtener los datos del controlador
                "columns": [
                    { "data": "title" },
                    { "data": "content" },
                    // Aquí puedes agregar más columnas si es necesario
                    {
                        "data": null,
                        "render": function(data, type, row) {
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

            // Aplicar un filtro para cada columna
            $('#myTable thead th').each(function() {
                var title = $(this).text();
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            });

            // Evento para aplicar los filtros
            table.columns().every(function() {
                var that = this;
                $('input', this.header()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });

            // Evento clic para el botón de editar
            $('#myTable').on('click', '.editBtn', function() {
                var noteId = $(this).data('id');
                // Aquí puedes redirigir a la página de edición de la nota
                console.log(noteId);
                window.location.href = '/notas/' + noteId + '/editar';
            });

            // Evento clic para el botón de eliminar
            $('#myTable').on('click', '.deleteBtn', function() {
                var noteId = $(this).data('id');

                if (confirm('¿Estás seguro de que deseas eliminar esta nota?')) {
                    $.ajax({
                        url: '/notas/' + noteId,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result) {
                            // La nota se eliminó correctamente, puedes realizar cualquier acción adicional aquí si es necesario
                            // Por ejemplo, recargar la tabla de notas
                            $('#myTable').DataTable().ajax.reload();
                        },
                        error: function(xhr, status, error) {
                            // Si hay algún error al eliminar la nota, puedes manejarlo aquí
                            $('#myTable').DataTable().ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
</x-layout>
