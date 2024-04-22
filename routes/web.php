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

//Routa , [Controlador,Metodo]
Route::redirect('/', '/users/register');
Route::get('/notas',[\App\Http\Controllers\NoteController::class,'index'])->name('notes.index');
//Route::get('/notas/{id}',[\App\Http\Controllers\NoteController::class,'show']);
Route::delete('/notas/{id}/', [\App\Http\Controllers\NoteController::class,'destroy'])->name('notes.destroy');
Route::get('/notas/crear',[\App\Http\Controllers\NoteController::class,'create'])->name('notes.create');
Route::post('/notas',[\App\Http\Controllers\NoteController::class,'store'])->name('notes.store'); //Convencion para rutas de tipo recurso
Route::get('/notas/{id}/editar', [\App\Http\Controllers\NoteController::class,'edit'])->name('notes.edit');
Route::put('/notas/{id}/', [\App\Http\Controllers\NoteController::class,'update'])->name('notes.update');
Route::patch('/notas/{id}', [\App\Http\Controllers\NoteController::class,'update'])->name('notes.update');
Route::get('/notas/all', [\App\Http\Controllers\NoteController::class,'getData'])->name('data.get');
Route::get('/users',[\App\Http\Controllers\UserController::class,'index'])->name('users.index');
Route::get('/users/register',[\App\Http\Controllers\UserController::class,'reguister'])->name('users.register');

/*
//Aqui le estas indicando que solo se pueden utilizar numeros

Route::get('cursos', function (){
    return [
        'Cursos' => [
            'Curso de laravel 10',
            'Cursos de programacion orientada a objetos',
            'Curso 3',
        ]
    ];
}
*/
