<?php

namespace Database\Seeders;

use App\Models\Discussion;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DiscussionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t='unable to connect python to mysql';

        Discussion::create([
            'title'=>$t,
            'slug'=>Str::slug($t),
            'content'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam sunt maxime? Atque velit obcaecati sed nesciunt? Fuga, veritatis sequi?',
            'channel_id'=>'3',
            'user_id'=>'1'
        ]);
        $t='How to add hidden attribute to an open file';

        Discussion::create([
            'title'=>$t,
            'slug'=>Str::slug($t),
            'content'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam sunt maxime? Atque velit obcaecati sed nesciunt? Fuga, veritatis sequi?',
            'channel_id'=>'4',
            'user_id'=>'1'
        ]); 
	$t='EasyAdmin3: Passing additional variables to twig-template (EDIT page)';

        Discussion::create([
            'title'=>$t,
            'slug'=>Str::slug($t),
            'content'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam sunt maxime? Atque velit obcaecati sed nesciunt? Fuga, veritatis sequi?',
            'channel_id'=>'2',
            'user_id'=>'2'
        ]); 
	$t='EasyAdmin3: Passing additional variables to twig-template (EDIT page)';

        Discussion::create([
            'title'=>$t,
            'slug'=>Str::slug($t),
            'content'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam sunt maxime? Atque velit obcaecati sed nesciunt? Fuga, veritatis sequi?',
            'channel_id'=>'2',
            'user_id'=>'1'
        ]); $t='How to extract datas of a special year from a csv file?';

        Discussion::create([
            'title'=>$t,
            'slug'=>Str::slug($t),
            'content'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam sunt maxime? Atque velit obcaecati sed nesciunt? Fuga, veritatis sequi?',
            'channel_id'=>'5',
            'user_id'=>'1'
        ]); 
        $t='How to set mat-autocomplete options programmatically with an array or object';

        Discussion::create([
            'title'=>$t,
            'slug'=>Str::slug($t),
            'content'=>'Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit veniam sunt maxime? Atque velit obcaecati sed nesciunt? Fuga, veritatis sequi?',
            'channel_id'=>'1',
            'user_id'=>'2'
        ]);
    }
}
