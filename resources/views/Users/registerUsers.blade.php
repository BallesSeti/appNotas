<x-layout xmlns:x-slot="http://www.w3.org/1999/xlink">

    <x-slot:title>Nueva Nota</x-slot:title>

    <main class="content">
        <div class="cards">
            <div class="card card-center">
                <div class="card-body">
                    <h1>Reguistrar Usuario</h1>

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

                        <label for="name" class="field-label">Name : </label>
                        <input type="text" name="name" id="name" class="field-input ">
                        {{-- Control de errores por cada campo--}}
                        @error('name')

                        <p class="error-menssage">{{$message}}</p>

                        @enderror

                        <label for="lastName" class="field-label">Last Name:</label>
                        <textarea name="lastName" id="lastName" rows="10" class="field-textarea"></textarea>
                        @error('content')

                        <p class="error-menssage">{{$message}}</p>


                        @enderror
                        <label for="birthdate" class="field-label">Birthdate:</label>
                        <input type="date" name="birthdate" id="birthdate" class="field-input">
                        @error('time')

                        <p class="error-message">{{$message}}</p>

                        @enderror


                        @if ($errors->any())
                            <x-alert type="error">
                            </x-alert>
                        @endif


                        <button type="submit" class="btn btn-primary">Reguister</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-layout>
