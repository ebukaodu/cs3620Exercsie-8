 <?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tag = new \App\Tag();
        $tag->tagit = 'COMPUTERS & TABLETS';
        $tag->save();

        $tag = new \App\Tag();
        $tag->tagit = 'TV, AUDIO & SURVEILLANCE';
        $tag->save();

        $tag = new \App\Tag();
        $tag->tagit = 'VIDEO GAMES & CONSOLES';
        $tag->save();

        $tag = new \App\Tag();
        $tag->tagit = 'CELL PHONES & ACCESSORIES';
        $tag->save();

        $tag = new \App\Tag();
        $tag->tagit = 'CAR ELECTRONICS & GPS';
        $tag->save();

        $tag = new \App\Tag();
        $tag->tagit = 'CAMERAS & CAMCORDERS';
        $tag->save();


    }
}
