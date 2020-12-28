<?php

namespace Database\Seeders;

use App\Models\Channel;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $t='Php';
        Channel::create([
            'name'=>$t,
            'slug'=>Str::slug($t)
        ]);
        $t='Laravel';

        Channel::create([
            'name'=>$t,
            'slug'=>Str::slug($t)

        ]);
        $t='Bootstrap';
        Channel::create([
            'name'=>$t,
            'slug'=>Str::slug($t)

        ]);
        $t='Jquery';
        Channel::create([
            'name'=>$t,
            'slug'=>Str::slug($t)

        ]);
        $t='Graphic designing';

        Channel::create([
            'name'=>$t,
            'slug'=>Str::slug($t)

        ]);
        $t='web development';
        Channel::create([
            'name'=>$t,
            'slug'=>Str::slug($t)

        ]);
    }
}
