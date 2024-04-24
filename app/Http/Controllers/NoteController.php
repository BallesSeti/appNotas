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
        \Log::info('Contenido de la solicitud:', $request->all());

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'time' => 'nullable|date',
        ]);

        Note::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'time' => $request->input('time'), // Asignar el valor del campo "time" del formulario
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
            'time' => 'required',
        ]);

        $note->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'time' => $request->input('time'),
        ]);

        return redirect('notas');
    }
/*
    public function destroy($id)
    {
        error_log("Entramos en el metodo destroy");
        /*
        $note = Note::findOrFail($id);
        $note->delete();
        *//*
        DB::table('notes')->where('id', $id)->delete();
        return redirect()->route('notes.index');
    }
*/
    public function destroy($id)
    {
        $note = Note::findOrFail($id);

        // Marcar la nota como eliminada estableciendo la fecha en la columna "deleted_at"
        $note->update([
            'deleted_at' => now()
            //console.log("Marcada");
        ]);

        return redirect()->route('notes.index');
    }


    public function getData(Request $request)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $searchTitle = $request->input('search.title');
        $searchContent = $request->input('search.content');
        $searchTime = $request->input('search.time');

        $query = Note::query();

        // Aplicar filtros de búsqueda si hay valores
        if (!empty($searchTitle)) {
            $query->where('title', 'like', '%' . $searchTitle . '%');
        }

        if (!empty($searchContent)) {
            $query->where('content', 'like', '%' . $searchContent . '%');
        }

        if (!empty($searchTime)) {
            // Si estás utilizando Carbon, puedes convertir la cadena de fecha a un objeto Carbon para realizar la comparación
            $query->whereDate('time', '=', $searchTime);
        }

        $totalRecords = $query->count();
        $filteredRecords = $query->count();

        // Aplicar paginación y límites después de aplicar el filtro
        $data = $query->select('id', 'title', 'content', 'time')
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
