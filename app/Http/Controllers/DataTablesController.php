<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class DataTablesController extends Controller
{
    public function getData(Request $request)
    {

        //input = entrada ;
        $start = $request->input('start', 0);
        $length = $request->input('length', 5);

        $query = Note::query();

        $totalRecords = Note::all()->count();
        //$data = $query->select('title', 'content')->offset($start)->limit($length)->get();
        $data = $query->select('title', 'content')->get();

        //  return datatables()->of($data)->toJson() ;

        return response()->json([
            "draw" => intval($request->input('draw', 1)),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $length,
            "data" => $data
        ]);
    }
}
