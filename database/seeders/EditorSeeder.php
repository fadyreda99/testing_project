<?php

namespace Database\Seeders;

use App\Models\Editor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EditorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Editor::create([
            'name' => 'editor',
            'email' => 'editor@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
