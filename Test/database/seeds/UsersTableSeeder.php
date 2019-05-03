<?php
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{

    public function run()
    {
        //shop user
        $user = new \App\User;
        $user->name = "shopuser";
        $user->email = "shopuser@gmail.com";
        $user->password = bcrypt('secret');
        $user->isAdmin = false;
        $user->firstname = "Max";
        $user->lastname = "Mustermann";
        $user->street = "Musterstrasse";
        $user->street_number = 1;
        $user->city = "Munich";
        $user->zip_code = 83779;
        $user->country = "Germany";
        $user->save();



        //administrator
        $user1 = new \App\User;
        $user1->name = "admin";
        $user1->email = "admin@gmail.com";
        $user1->password = bcrypt('secret');
        $user1->isAdmin = true;
        $user1->firstname = "Thomas";
        $user1->lastname = "Achatz";
        $user1->street = "Ramwoldweg";
        $user1->street_number = 3;
        $user1->city = "Salching";
        $user1->zip_code = 94330;
        $user1->country = "Germany";
        $user1->save();



        $user2 = new \App\User;
        $user2->name = "shopuser2";
        $user2->email = "shopuser2@gmail.com";
        $user2->password = bcrypt('secret');
        $user2->isAdmin = false;
        $user2->firstname = "Daniel";
        $user2->lastname = "Kroiss";
        $user2->street = "Musterstraße";
        $user2->street_number = 1;
        $user2->city = "Linz";
        $user2->zip_code = 4040;
        $user2->country = "Austria";
        $user2->save();
    }
}