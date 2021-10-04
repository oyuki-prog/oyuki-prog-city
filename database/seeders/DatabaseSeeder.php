<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CategorySeeder::class,
            PrefectureSeeder::class
        ]);
        if (!Storage::directories('public')) {
            \App\Models\User::factory(20)->create();
            \App\Models\Article::factory(40)->create();
            \App\Models\Image::factory(100)->create();
        }
    }
}
