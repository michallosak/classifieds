<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(ClassifiedsSeeder::class);
        $this->call(FollowsSeeder::class);
        $this->call(PhotosSeeder::class);
    }
}
