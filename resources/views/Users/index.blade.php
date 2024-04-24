<x-layout>

    <main class="content">

        <div class="filtro-container">
            <h2 id="filtro-header">FILTROS DE BÚSQUEDA</h2>
            <ul class="filtro-menu">
                <li><input type="search" id="searchField_1_user" class="searchField" placeholder="Search...Name"/></li>
                <li><input type="search" id="searchField_2_user" class="searchField" placeholder="Search...LastName"/></li>
                <li><input type="search" id="searchField_3_user" class="searchField" placeholder="Search...email"/></li>
                <li><input type="date" id="searchField_4_user" class="searchField"></li>
            </ul>
        </div>
        <script src="{{ asset('js/script.js') }}"></script>

        <table id="tableUsers" class="tabla">
            <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>email</th>
                <th>birthdate</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- Aquí se agregarán las filas de la tabla con los datos de las notas --}}
            </tbody>
        </table>

        <div id="data" data-url="{{ route('data.get.user') }}"></div>
        <script src="{{ asset('js/user/user.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
        <script src="{{ asset('js/index.js') }}" type="module"></script>

    </main>

</x-layout>
