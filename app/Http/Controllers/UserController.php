<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function reguister()
    {
        return view('users.registerUsers');
    }

    public function getData(Request $request)
    {
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $searchName = $request->input('search.name');
        $searchLastName = $request->input('search.lastname');
        $searchEmail = $request->input('search.email');
        $searchBirthday = $request->input('search.birthday');

        $query = User::query();

        // Aplicar filtros de búsqueda si hay valores
        if (!empty($searchName)) {
            $query->where('name', 'like', '%' . $searchName . '%');
        }

        if (!empty($searchLastName)) {
            $query->where('lastName', 'like', '%' . $searchLastName . '%');
        }

        if (!empty($searchEmail)) {
            $query->where('email', 'like', '%' . $searchEmail . '%');
        }

        if (!empty($searchBirthday)) {
            // Si estás utilizando Carbon, puedes convertir la cadena de fecha a un objeto Carbon para realizar la comparación
            $query->whereDate('birthday', '=', $searchBirthday);
        }

        $totalRecords = $query->count();
        $filteredRecords = $query->count();

        // Aplicar paginación y límites después de aplicar el filtro
        $data = $query->select('id', 'name', 'lastName', 'email' , 'birthday')
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
