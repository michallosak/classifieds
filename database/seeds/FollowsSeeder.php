<?php

use Illuminate\Database\Seeder;

class FollowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            \App\Model\Follow\Follow::create([
                'user_id' => rand(1, 10),
                'follow_id' => rand(1, 10),
                'follow_type' => 'AD'
            ]);
        }
    }
}
