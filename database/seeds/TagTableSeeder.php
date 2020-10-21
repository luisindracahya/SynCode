<?php

use Illuminate\Database\Seeder;
use App\tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = collect(['Love','Science','Computer','Music','Family','Education','Cooking']);
        $tags->each(function($item){
            tag::create([
                'tag_name'=>$item
            ]);
        });
    }
}
