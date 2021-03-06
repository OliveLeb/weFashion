<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SizeTableSeeder;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\ProductTableSeeder;
use Database\Seeders\CategoryTableSeeder;

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
        $this->call([
            CategoryTableSeeder::class,
            SizeTableSeeder::class,
            ProductTableSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
