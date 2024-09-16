<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notes')->insert([
            [
                'title' => 'A branca de neve',
                'text' => 'Era uma vez blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá',
                'created_at' => date('Y:m:d H:i:s'),
            ],
            [
                'title' => 'O gato de botas',
                'text' => 'Era uma vez blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá',
                'created_at' => date('Y:m:d H:i:s'),
            ],
            [
                'title' => 'Chaves developer',
                'text' => 'Era uma vez blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá',
                'created_at' => date('Y:m:d H:i:s'),
            ],

        ]);
    }
}
