<?php

use Illuminate\Database\Seeder;

class PhotosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 100; $i ++)
        {
            $photo = [
                'https://www.attractionsofamerica.com/images/travel/20180304094416_beautiful-mountains-usa.jpg' => 1,
                'https://upload.wikimedia.org/wikipedia/commons/thumb/0/00/Wrangells1.jpg/446px-Wrangells1.jpg' => 2,
                'https://20dqe434dcuq54vwy1wai79h-wpengine.netdna-ssl.com/wp-content/uploads/2017/04/Cameron-Pass-Nohku-Crags-Robert-Ford-OutThere-Colorado-1024x685.jpg' => 3,
                'https://i0.wp.com/blog.americanexpedition.us/wp-content/uploads/2017/01/maroonbells.jpg' => 4,
                'https://attractionsofamerica-attractionsofame1.netdna-ssl.com/images/all_travel/20180304092153_denali-alaska.jpg' => 5,
                'http://www.beyond-magazine.com/wp-content/uploads/2015/04/Rocky-Mountains-USA.jpg' => 6,
                'https://www.adventuredestinations.com.au/wp-content/uploads/USA_Montana-Beartooth-Highway1.png' => 7,
                'https://www.gearhungry.com/wp-content/uploads/2019/01/fall-foliage-colorado.jpg' => 8,
                'https://i0.wp.com/theverybesttop10.com/wp-content/uploads/2017/12/The-Top-10-Highest-Mountains-in-the-USA-and-Where-to-Find-Them-600x400.jpg?zoom=2.625&resize=356%2C237' => 9,
                'https://www.bradtguides.com/media/wysiwyg/destinations/north-america-and-caribbean/usa/adirondack_mountains_usa_Hugo_Brizard_-_YouGoPhoto_Shutterstock.jpg' => 10
            ];
            $r = rand(1, 10);
            \App\Model\Photo\Photo::create([
                'user_id' => $r,
                'photo_id' => $r,
                'href' => array_rand($photo),
                'type' => 'AD'
            ]);
        }
    }
}
