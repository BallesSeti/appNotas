<?php

namespace Database\Seeders;

use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $note = new Note ;

        $note->title = 'Aprendiendo Blade';
        $note->content  = 'Contenido Blade';

        $note->save();

        for ($i = 1; $i <= 5; $i++) {
            DB::table('notes')->insert([
                'title' => 'Tarea ' . $i,
                'content' => 'Contenido',
            ]);
        }
    }
}
