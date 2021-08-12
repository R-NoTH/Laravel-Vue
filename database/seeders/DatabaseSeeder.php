<?php

namespace Database\Seeders;

use App\Models\Articulo;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Articulo::factory(30)->create();
        Book::factory(10)->create();
    }
}
