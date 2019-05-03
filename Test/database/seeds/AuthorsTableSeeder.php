<?php
use Illuminate\Database\Seeder;
class AuthorsTableSeeder extends Seeder
{

    public function run()
    {
        $author1 = new \App\Author;
        $author1->firstName = "Max";
        $author1->lastName = "Mustermann";
        $author1->save();
        $author2 = new \App\Author;
        $author2->firstName = "Susi";
        $author2->lastName = "Musterfrau";
        $author2->save();
        $author3 = new \App\Author;
        $author3->firstName = "Michael";
        $author3->lastName = "Meier";
        $author3->save();
    }
}