<x-layout>
    {{--VITE Carga de archivos dinámicas--}}

    <main class="content">

        <div class="filtro-container">
            <h2 id="filtro-header">FILTROS DE BÚSQUEDA</h2>
            <ul class="filtro-menu">
                <li><input type="search" id="searchField_1_note" class="searchField" placeholder="Search...Title"/></li>
                <li><input type="search" id="searchField_2_note" class="searchField" placeholder="Search...Content"/></li>
                <li><input type="date" id="searchField_3_note" class="searchField"></li>
                <li><label><input type="checkbox"> Mostrar notas en la papelera</label></li>
            </ul>
        </div>
        <script src="{{ asset('js/script.js') }}"></script>

         <table id="tableNotas" class="tabla">
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

        <div id="data" data-url="{{ route('data.get.note') }}"></div>
        <script src="{{ asset('js/notes/notas.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <script src="{{ asset('js/index.js') }}" type="module"></script>
    </main>

</x-layout>
