<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            PublicPlacesTableSeeder::class,
            TypeUsersTableSeeder::class,
            GroupExercisesTableSeeder::class,
            ExercisesTableSeeder::class
        ]);
    }
}
