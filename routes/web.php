<?php

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

    $notes = \Illuminate\Support\Facades\DB::table('notes')->get();

    return view('notes.index')->with('notes',$notes); //resources/views

})->name('notes.index');

Route::get('/notas/crear', function (){
    return view('notes.create');
})->name('notes.create');

Route::get('/notas/{$detalle}', function ($detalle){
    return 'detalle de la nota'.$detalle;
});
/*
//Editar las notas mediante el $id
Route::get('/notas/{id}/editar', function ($id) {
    // Asegúrate de definir y asignar un valor a la variable $notes
    $notes = Nota::findOrFaill($id);

    // Verifica si la nota existe antes de continuar
    abort_if($notes === null, 404);

    // Devuelve un mensaje junto con el resultado de la búsqueda
    return 'Editar notas: ' . $notes->find($id);
})->where('id', '\d+');
*/

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
