<x-layout>
    {{--VITE Carga de archivos dinamicas--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/button.css') }}">
    <script src="{{ asset('js/notes/index.js') }}"></script>º
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
                                @method('DELETE')
                                @csrf
                            </div>

                        </td>
                    </tr>
                @endforeach
            </table>
            </tbody>
                        {{-- Acciones de edición y eliminación --}}
                        {{--
                        <footer class="card-footer">
                            {{-- <a href="{{ $note->getEditUrlAttribute }}" class="action-link action-edit">--}}{{--
                            <a href="{{ $note->getEditUrl() }}" class="action-link action-edit">
                                <i class="icon icon-pen"></i>
                            </a>
                         </a>
                         <a href="{{route('notes.destroy',$note)}}" class="action-link action-delete">
                             @method('DELETE')
                             @csrf
                             <i class="icon icon-trash"></i>
                         </a>
                     </footer>
                        --}}
             {{--
                             <div class="cards">
                            // <?php foreach ($notes as $note): ?>
                             @forelse($notes as $note)

                             <div class="card card-small">
                                 <div class="card-body">
                                     //Sintaxis de blade
                                     //Nos protege de intento de robo de codigo
                                     <h4>{{ $note }}</h4>
                                     //Sintaxis php
                                     <p>
                                         <?php echo $note; ?>
                                     </p>
                                 </div>

                                 <footer class="card-footer">
                                     <a class="action-link action-edit">
                                         <i class="icon icon-pen"></i>
                                     </a>
                                     <a class="action-link action-delete">
                                         <i class="icon icon-trash"></i>
                                     </a>
                                 </footer>
                             </div>
                             //<?php endforeach;?>

                                 @empty
                                 <p>
                                     no tenemos notas
                                 </p>
                            @endforelse
                                 --}}
        </main>
</x-layout>


