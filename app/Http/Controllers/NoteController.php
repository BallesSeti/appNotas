<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::all();
        return view('notes.index')->with('notes', $notes);
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Note::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect('notas');
    }

    public function edit($id)
    {
        $note = Note::findOrFail($id);
        return view('notes.create', compact('note'));
    }

    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $note->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect('notas');
    }
    public function destroy($id)
    {
        /*
        $note = Note::findOrFail($id);
        $note->delete();
        */
        DB::table('notes')->where('id',$id)->delete();
        return redirect()->route('notes.index');
    }

}
