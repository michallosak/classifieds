<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i ++){
            \App\Model\Category\Category::create([
                'user_id' => rand(1, 10),
                'name' => 'Name Category ' . $i,
                'parent_id' => rand(1, 10),
                'status' => 1
            ]);
        }
    }
}
