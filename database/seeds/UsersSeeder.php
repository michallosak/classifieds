<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            $sex = rand(0, 1);
            if ($sex != 1) {
                //man
                $avatar = 'http://intercastor.pl/wp-content/uploads/2017/01/default_user_icon.jpg';
                $name = 'Jan';
                $email = 'jan';
            } else {
                // woman
                $avatar = 'http://babyathome.pl/wp-content/uploads/2014/07/avatar-woman.png';
                $name = 'Kasia';
                $email = 'kasia';
            }
            $user = \App\User::create([
                'email' => $email . '.losak' . +$i . '@op.pl',
                'password' => bcrypt('HarmonRabb14'),
                'activated' => 1
            ]);
            \App\Model\User\Avatar::create([
                'user_id' => $user->id,
                'src' => $avatar
            ]);
            $s = \App\Model\User\Specific::create([
                'user_id' => $user->id,
                'name' => $name,
                'birthday' => '2000-08-20',
                'sex' => $sex,
                'type_account' => rand(1, 2)
            ]);
            if ($s->type_account === 2){
                \App\Model\User\Company::create([
                    'user_id' => $user->id,
                    'name' => 'Name company',
                    'nip' => '0020020020'.$i,
                    'country' => 'USA',
                    'address' => 'Stanford s',
                    'city' => 'Dallas',
                    'post_code' => '26-021'
                ]);
            }
            \App\Model\User\Contact::create([
                'user_id' => $user->id,
                'email' => $user->email
            ]);
        }
    }
}
