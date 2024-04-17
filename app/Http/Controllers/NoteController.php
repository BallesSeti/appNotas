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
        DB::table('notes')->where('id', $id)->delete();
        return redirect()->route('notes.index');
    }

    public function getData(Request $request)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $searchValue = $request->input('search.value');

        \Log::info('Valor del filtro de búsqueda:', ['value' => $searchValue]); // Agregar log para imprimir el valor del filtro

        $query = Note::query();

        // Aplicar el filtro de búsqueda si hay un valor de búsqueda
        if (!empty($searchValue)) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('content', 'like', '%' . $searchValue . '%');
            });
        }

        $totalRecords = $query->count();

        // Aplicar paginación y límites después de aplicar el filtro
        $filteredRecords = $query->count();
        $data = $query->select('id', 'title', 'content')
            ->skip($start)
            ->take($length)
            ->get();

        return response()->json([
            "draw" => intval($request->input('draw', 1)),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }
}
