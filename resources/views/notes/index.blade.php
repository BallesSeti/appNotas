<x-layout>
    {{--VITE Carga de archivos dinámicas--}}

    <main class="content">

        <div class="filtro-container">
            <h2 id="filtro-header">FILTROS DE BÚSQUEDA</h2>
            <ul class="filtro-menu">
                <li><input type="search" id="searchField_1" class="searchField" placeholder="Search...Title"/></li>
                <li><input type="search" id="searchField_2" class="searchField" placeholder="Search...Content"/></li>
                <li><input type="date" id="searchField_3" class="searchField"></li>
               <li><label><input type="checkbox"> Mostrar notas en la papelera</label></li>
            </ul>
            {{--  <button class="buscar-button">Buscar Ahora</button>--}}
         </div>


         <script src="{{ asset('js/script.js') }}"></script>

         <table id="myTable" class="display">
             <thead>
             <tr>
                 <th>Title</th>
                 <th>Content</th>
                 <th>Time</th>
                 <th>Actions</th>
             </tr>
             </thead>
             <tbody>
             {{-- Aquí se agregarán las filas de la tabla con los datos de las notas --}}
            </tbody>
        </table>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">

    </main>

    <script>console.log("cargado index");
        $(document).ready(function () {
            var table = $('#myTable').DataTable({
                "paging": true, // Habilitar paginación
                "processing": true,
                "serverSide": true, // Habilitar el modo de procesamiento del lado del servidor
                "ajax": {
                    url: "{{ route('data.get') }}",
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
