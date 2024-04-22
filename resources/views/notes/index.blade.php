<x-layout>
    {{--VITE Carga de archivos dinámicas--}}

    <main class="content">

        <x-filter></x-filter>

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

        <script src="{{ asset('js/user/user.js') }}"  type="module"></script>
        <x-script></x-script>

    </main>

</x-layout>
