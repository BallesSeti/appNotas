<x-layout>

    <main class="content">

        <x-filter></x-filter>

        <table id="tableUsers" class="tabla">
            <thead>
            <tr>
                <th>Name</th>
                <th>Last Name</th>
                <th>birthdate</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- Aquí se agregarán las filas de la tabla con los datos de las notas --}}
            </tbody>
        </table>

        <x-script></x-script>

    </main>

</x-layout>
