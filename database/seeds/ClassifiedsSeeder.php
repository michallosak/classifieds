<?php

use Illuminate\Database\Seeder;

class ClassifiedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i ++){
            \App\Model\Page\Advertisement::create([
                'user_id' => rand(1,10),
                'category_id' => rand(1, 10),
                'title' => 'Title Advertisement' . $i,
                'body' => 'Aliquam rhoncus nulla quis dolor pretium, et convallis enim sollicitudin. Suspendisse a laoreet mi. Vestibulum pharetra, nulla quis molestie sollicitudin, libero ligula finibus tellus, non ornare justo ligula id dui. Donec rutrum nisl a purus imperdiet, nec accumsan felis lacinia. Nulla ullamcorper urna nec enim viverra, accumsan aliquet tortor sodales. Sed dui dui, faucibus imperdiet iaculis sollicitudin, lobortis quis eros. Phasellus at dolor hendrerit, molestie augue eu, ultricies elit. Pellentesque at dolor varius, varius lorem non, porta ligula. Nunc ac ante sagittis lacus imperdiet mollis sed at sem. Phasellus ornare accumsan maximus. Donec rhoncus sodales lacus, vitae facilisis mi fringilla varius. Sed risus turpis, faucibus et gravida eu, ornare fringilla turpis. Morbi rhoncus, mauris quis volutpat tincidunt, odio eros efficitur metus, non volutpat metus est ullamcorper nulla. Donec quis sodales purus. Cras ac neque lacinia, viverra justo at, venenatis turpis. Mauris lobortis massa congue dictum vestibulum.',
                'location' => 'City' . $i
            ]);
        }
    }
}
