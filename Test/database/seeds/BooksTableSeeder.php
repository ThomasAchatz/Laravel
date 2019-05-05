
<?php
use Illuminate\Database\Seeder;
class BooksTableSeeder extends Seeder
{

    public function run()
    {

        $book = new \App\Book;
        $book->title = "Wir entdecken den Weltraum";
        $book->isbn = '1234567890';
        $book->subtitle = 'Wieso, Weshalb, Warum?';
        $book->rating = 5;
        $book->description = 'Ein tolles Buch für Kinder und Erwachsene';
        $book->published = new DateTime();
        $book->price = 20;
        $user = \App\User::all()->first();
        $book->user()->associate($user);
        $book->save();
        $authors = \App\Author::all()->pluck("id");
        $book->authors()->sync($authors);


        //add images to book
        $image1 = new \App\Image;
        $image1->title = "Cover 1";
        $image1->url = "https://images-na.ssl-images-amazon.com/images/I/51X2SB0lNGL._AC_SX290_SY290_.jpg";
        $image1->book()->associate($book);
        $image1->save();
        $image2 = new \App\Image;
        $image2->title = "Cover 2";
        $image2->url = "https://images-na.ssl-images-amazon.com/images/I/51X2SB0lNGL._AC_SX290_SY290_.jpg";
        $image2->book()->associate($book);
        $image2->save();



        $book1 = new \App\Book;
        $book1->title = "Abenteurer und Entdecker";
        $book1->isbn = '12345678901';
        $book1->subtitle = 'Krimi';
        $book1->rating = 9;
        $book1->description = 'Was damals wirklich auf der Arche Noah passierte';
        $book1->published = new DateTime();
        $book1->price = 25;
        $user = \App\User::all()->first();
        $book1->user()->associate($user);
        $book1->save();
        $authors = \App\Author::all()->pluck("id");
        $book1->authors()->sync($authors);
        $image3 = new \App\Image;
        $image3->title = "Cover 1";
        $image3->url = "https://images-na.ssl-images-amazon.com/images/I/51r8hgIYGML._SX426_BO1,204,203,200_.jpg";
        $image3->book()->associate($book1);
        $image3->save();
    }
}