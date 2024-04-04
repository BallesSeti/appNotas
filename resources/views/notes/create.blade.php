<x-layout xmlns:x-slot="http://www.w3.org/1999/xlink">

<x-slot:title>Nueva Nota</x-slot:title>

<main class="content">
    <div class="cards">
        <div class="card card-center">
            <div class="card-body">
                <h1>Nueva nota</h1>

                <form action="{{route('notes.store')}}" method="POST">

                    {{--
                    Sirve a modo de seguridad para que un sitio web
                    malicioso no pueda enviar solicitudes no autorizadas a un
                    sitio web legítimo,aprovechando la sesion autentica del usuario
                     --}}
                    @csrf

                    <label for="title" class="field-label">Título: </label>
                    <input type="text" name="title" id="title" class="field-input">

                    <label for="content" class="field-label">Contenido:</label>
                    <textarea name="content" id="content" rows="10" class="field-textarea"></textarea>

                    <button type="submit" class="btn btn-primary">Crear nota</button>
                </form>
            </div>
        </div>
    </div>
</main>
</x-layout>
