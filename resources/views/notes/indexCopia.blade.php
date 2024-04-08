<x-layout>
        <main class="content">
            <div class="cards">
                {{-- Iteramos a través de las notas utilizando Blade --}}
                @foreach ($notes as $note)
                    <div class="card card-small">
                        <div class="card-body">
                            {{-- Sintaxis de Blade AMEDIAS: Imprimimos el contenido de la nota --}}
                            <h4>{{ $note -> title }}</h4>

                            {{-- Sintaxis PHP: Imprimimos el contenido de la nota utilizando PHP --}}
                            <p>
                                    {{--<?php echo $note; ?>--}}
                                {{$note -> content}}
                            </p>

                            <form method="POST" action="{{route('notes.destroy',$note)}}">
                                @method('DELETE')
                                @csrf
                            {{--<input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{csrf_token()}}}">--}}
                                <button>Eliminar</button>
                            </form>

                        </div>
                        {{-- Acciones de edición y eliminación --}}
                        <footer class="card-footer">
                            {{-- <a href="{{ $note->getEditUrlAttribute }}" class="action-link action-edit">--}}
                            <a href="{{ $note->getEditUrl() }}" class="action-link action-edit">
                                <i class="icon icon-pen"></i>
                            </a>
                         </a>
                         <a class="action-link action-delete">
                             <i class="icon icon-trash"></i>
                         </a>
                     </footer>
                 </div>
             @endforeach

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
            </div>
        </main>
</x-layout>

