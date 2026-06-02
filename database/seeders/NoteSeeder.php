<?php
 
namespace Database\Seeders;
 
use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Seeder;
 
class NoteSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'admin@demo.com')->first();
 
        $notes = [
            ['title' => 'Catatan Pertama',  'content' => 'Ini adalah catatan demo pertama.'],
            ['title' => 'Belanja Minggu Ini', 'content' => 'Susu, telur, roti, dan kopi.'],
            ['title' => 'Rencana Belajar',  'content' => 'Flutter, Laravel, dan JWT auth.'],
        ];
 
        foreach ($notes as $note) {
            Note::create([
                'user_id' => $user->id,
                'title'   => $note['title'],
                'content' => $note['content'],
            ]);
        }
    }
}
