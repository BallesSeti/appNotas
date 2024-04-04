<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {

        $notes = Note::query()
            ->orderByDesc('id')
            ->get();


        return view('notes.index')->with('notes', $notes); //resources/views
    }

    public function create()
    {
        return view('notes.create');
    }
/*
    public function show($id)
    {
       return 'Detalle de la nota '.$id;
    }
*/
    public function store(Request $request)
    {
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

        return redirect('notas');
        //return back();
    }
    public function edit()
    {
        $notes = Note::query()
            ->orderByDesc('id')
            ->get();

        return view('notes.index')->with('notes',$notes);
    }

}
