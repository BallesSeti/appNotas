<?php

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', function () {
    return 'Pagina de inicio';
});

Route::get('/notas', function (){

    /*
     * $notes = DB::table('notes')->get();
     * aqui nos conectamos a la base de datos y cogemos los datos
     */

    //Aqui estamos utilizando el modelo Note creado anteriormente
    //$notes = Note::all();

    $notes = Note::query()
        ->orderByDesc('id')
        ->get();


    return view('notes.index')->with('notes',$notes); //resources/views

})->name('notes.index');

Route::get('/notas/crear', function (){

    return view('notes.create');

})->name('notes.create');

Route::post('/notas', function (\Illuminate\Http\Request $request){

    //Validacion de datos
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    //Note::create(Request::all()).'Notas Creada';
    Note::create([

        'title' => $request->input('title'),
        'content' => $request->input('content'),

    ]);

    //return redirect()->route('notes.index');
    return back();

})->name('notes.store'); //Convencion para rutas de tipo recurso

Route::get('/notas/{$detalle}', function ($detalle){

    return 'detalle de la nota'.$detalle;

})->name('notes.detalle');;

//Editar las notas mediante el $id
Route::get('/notas/{id}/editar', function ($id) {

    // Asegúrate de definir y asignar un valor a la variable $notes
    $notes = Note::all($id);

    // Verifica si la nota existe antes de continuar
    abort_if($notes === null, 404);

    // Devuelve un mensaje junto con el resultado de la búsqueda
    return 'Editar notas: ' . $notes->find($id);

})  ->name('notes.edit')
    ->where('id', '\d+');


//Aqui le estas indicando que solo se pueden utilizar numeros

Route::get('cursos', function (){
    return [
        'Cursos' => [
            'Curso de laravel 10',
            'Cursos de programacion orientada a objetos',
            'Curso 3',
        ]
    ];
});
