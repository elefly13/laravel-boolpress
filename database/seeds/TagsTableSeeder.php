<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Tag;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = ['FrontEnd Dev', 'BackEnd Dev', 'MVC', 'Models', 'Seeders'];

        // for ($i = 0; $i < count($tags); $i++) {
        //    $new_tag = new Tag(); 
        //    $new_tag->name = $tags[$i];
        //    $new_tag->slug = Str::slug($tags[$i], '-');
        //    $new_tag->save();
        // }

        foreach($tags as $tag) {
            $new_tag = new Tag(); 
            $new_tag->name = $tag;
            $new_tag->slug = Str::slug($tag, '-');
            $new_tag->save();
        }
    }
}
