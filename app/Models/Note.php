<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    //Indicamos atraves de la propiedad fillable los datos que si queremos guardar
    protected $fillable = ['title','content'];
    public function editUr()
    {
        return route('notes.edit',['id' => $this -> $id]);
    }
}
