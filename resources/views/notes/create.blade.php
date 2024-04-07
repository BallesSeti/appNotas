<x-layout xmlns:x-slot="http://www.w3.org/1999/xlink">

<x-slot:title>Nueva Nota</x-slot:title>

<main class="content">
    <div class="cards">
        <div class="card card-center">
            <div class="card-body">
                <h1>Nueva nota</h1>

                <form
                    action="{{ isset($note) ? route('notes.update', $note->id) : route('notes.store') }}"
                    method="POST">
                @if(isset($note))
                    @method('PUT')
                    @endif

                {{--
                    Sirve a modo de seguridad para que un sitio web
                    malicioso no pueda enviar solicitudes no autorizadas a un
                    sitio web legítimo,aprovechando la sesion autentica del usuario
                     --}}
                    @csrf

                    <label for="title" class="field-label">Título: </label>
                    <input type="text" name="title" id="title" class="field-input " value="@if(isset($note)){{ $note->title }}@endif">
                    {{-- Control de errores por cada campo--}}
                    @error('title')

                        <p class="error-menssage">{{$message}}</p>

                    @enderror

                    <label for="content" class="field-label">Contenido:</label>
                    <textarea name="content" id="content" rows="10" class="field-textarea"></textarea>
                    @error('content')

                    <p class="error-menssage">{{$message}}</p>


                    @enderror

                    @if ($errors->any())
                        <x-alert type="error">
                        </x-alert>
                    @endif


                    <button type="submit" class="btn btn-primary">{{ isset($note) ? 'Editar nota' : 'Crear nota' }}</button>
                </form>
            </div>
        </div>
    </div>
</main>
</x-layout>
