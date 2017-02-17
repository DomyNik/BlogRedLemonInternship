<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

        public function run()
        {
                $user = new \App\User([
                'position'=>'editor',
                'firstname'=>'Dominique',
                'lastname'=>'Abella',
                'email'=>'domy_michelle@yahoo.com',
                'password'=>$password = Hash::make('toliveischrist')
                 ]);$user->save();

                 $user = new \App\User([
                'position'=>'editor',
                'firstname'=>'Janette',
                'lastname'=>'Deligero',
                'email'=>'janette.deligero@gmail.com',
                'password'=>$password = Hash::make('secret')
                 ]);$user->save();
        
                 $user = new \App\User([
                'position'=>'contributor',
                'firstname'=>'Kevin',
                'lastname'=>'Tan',
                'email'=>'kevin.tan@gmail.com',
                'password'=>$password = Hash::make('secret')
                ]);$user->save();

                $user = new \App\User([
                'position'=>'contributor',
                'firstname'=>'Daphne',
                'lastname'=>'Abella',
                'email'=>'daphne.abella@gmail.com',
                'password'=>$password = Hash::make('secret')
                ]);$user->save();
        }




}