<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public $timestamps = false;

    //Indicamos atraves de la propiedad fillable los datos que si queremos guardar
    protected $fillable = [
        'title',
        'content',
        'time'
    ];
    public function getEditUrlAttribute()
    {
        return route('notes.edit', ['id' => $this->id]);
    }


}
