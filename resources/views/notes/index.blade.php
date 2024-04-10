<x-layout>
    {{--VITE Carga de archivos dinámicas--}}

    <link rel="stylesheet" type="text/css" href="{{ asset('css/button.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/datatables.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="" href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css">

    <main class="content">
        <table id="myTable" class="display">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($notes as $note)
                <tr>
                    <td>{{ $note->title }}</td>
                    <td>{{ $note->content }}</td>
                    <td>
                        <div>
                            <a class="btn-secondary" href="{{ $note->getEditUrlAttribute }}">Editar</a>
                            <a class="btn-danger" href="{{route('notes.destroy',$note)}}">Borrar</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    <script>

        $(document).ready(function(){
            var table = $('#myTable').DataTable({
                orderCellsTop: true,
                fixedHeader: true
            });

            //Creamos una fila en el head de la tabla y lo clonamos para cada columna
            $('#myTable thead tr').clone(true).appendTo( '#myTable thead' );

            $('#myTable thead tr:eq(1) th').each( function (i) {
                var title = $(this).text(); //es el nombre de la columna
                $(this).html( '<input type="text" placeholder="Search...'+title+'" />' );

                $( 'input', this ).on( 'keyup change', function () {
                    if ( table.column(i).search() !== this.value ) {
                        table
                            .column(i)
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        });
    </script>

</x-layout>
