<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(10)->create();

        \App\Models\Produto::create([
            'codigo' => 16458,
            'nome' => 'Pratros',
            'medicao' => 'Caixa',
            'qtd' => 120,
            'preco' => 24000,
            'perecivel'=> 'Sim',
            'categoria_id' => 1
        ]);
    }
}
