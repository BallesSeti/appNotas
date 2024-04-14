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
    public function all(Request $request)
    {
        return "Hola";
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
        error_log("Entramos en el metodo UPDATE");
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
        error_log("Entramos en el metodo destroy");
        /*
        $note = Note::findOrFail($id);
        $note->delete();
        */
        DB::table('notes')->where('id',$id)->delete();
        return redirect()->route('notes.index');
    }

    public function getData(Request $request)
    {
        $length = $request->input('length', 10);
        $page = $request->input('start', 0) / $length + 1;

        $query = Note::query();
        $totalRecords = $query->count();

        // Aplicar cualquier filtro si es necesario
        // Por ejemplo: $query->where('column', 'value');

        $filteredRecords = $query->count();
        $data = $query->select('id', 'title', 'content')->paginate($length);

        return response()->json([
            "draw" => intval($request->input('draw', 1)),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data->items() // Solo devuelve los datos paginados, no el objeto Paginator completo
        ]);
    }


}
