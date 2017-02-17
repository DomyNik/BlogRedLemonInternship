<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

        public function run()
        {
                $category = new \App\Category([
                'name'=>'love',
                'description'=>'romance, sacrifice, attachment, affection',
                'slug'=>'love'
                ]);$category->save();

                 $category = new \App\Category([
                'name'=>'technology',
                'description'=>'robots, computers, phones, electronics',
                'slug'=>'technology'
                ]);$category->save();

                  $category = new \App\Category([
                'name'=>'travel',
                'description'=>'places, culture',
                'slug'=>'travel'
                ]);$category->save();
        }




}