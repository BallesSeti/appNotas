<x-layout>
    {{--VITE Carga de archivos dinámicas--}}
    <main class="content">
        <table id="myTable" class="display">
            <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                {{--<th>Action</th>--}}
            </tr>
            </thead>
            {{--<tbody>
            @foreach ($notes as $note)
                <tr>
                    <td>{{ $note->title }}</td>
                    <td>{{ $note->content }}</td>
                    <td>
                        <div>
                            <button class="material-symbols-outlined"><a href="{{ $note->editUrl  }}">edit</a></button>
                                <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta nota?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="material-symbols-outlined" style="color:#AF0C0C">delete</button>º
                            </form>

--}}{{--                            <a class="btn-secondary" href="{{ $note->getEditUrlAttribute }}">Editar</a>--}}{{--
--}}{{--                            <a class="btn-danger" href="{{route('notes.destroy',$note)}}">Borrar</a>--}}{{--
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>--}}
        </table>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.6/js/dataTables.fixedHeader.min.js"></script>
    {{--<script src="{{ asset('js/notes/index.js') }}"></script>--}}

    <script>
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
    </script>

</x-layout>
