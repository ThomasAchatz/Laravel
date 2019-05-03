<?php
namespace App\Http\Controllers;
use App\Book;
use App\Image;
use App\Author;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class BookController extends Controller
{
    public function index(){

        $books = Book::with(['authors', 'images', 'user'])->get();
        return $books;
    }



    public function show($book){
    }
    public function findByISBN(string $isbn){
        $book = Book::where('isbn', $isbn)->with(['authors', 'images', 'user'])->first();
        return $book;
    }
    public function checkISBN(string $isbn){
        $book = Book::where('isbn', $isbn)->first();
        return $book != null ? response()->json('book with '.$isbn.' exists', 200) :
            response()->json('book with '.$isbn.' does not exists', 404);
    }


    public function findBySearchTerm(string $searchTerm) {
        $book = Book::with(['authors', 'images', 'user'])
            ->where('title', 'LIKE', '%' . $searchTerm. '%')
            ->orWhere('subtitle' , 'LIKE', '%' . $searchTerm. '%')
            ->orWhere('description' , 'LIKE', '%' . $searchTerm. '%')
            /* search term in authors name */
            ->orWhereHas('authors', function($query) use ($searchTerm) {
                $query->where('firstName', 'LIKE', '%' . $searchTerm. '%')
                    ->orWhere('lastName', 'LIKE',  '%' . $searchTerm. '%');
            })->get();
        return $book;
    }


    //new Book
    public function save(Request $request) : JsonResponse  {
        $request = $this->parseRequest($request);

        DB::beginTransaction();
        try {
            $book = Book::create($request->all());


            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $img) {
                    $image = Image::firstOrNew(['url'=>$img['url'],'title'=>$img['title']]);
                    $book->images()->save($image);
                }
            }
            if (isset($request['authors']) && is_array($request['authors'])) {
                foreach ($request['authors'] as $auth) {
                    $author = Author::firstOrNew(['firstName'=>$auth['firstName'],'lastName'=>$auth['lastName']]);
                    $book->authors()->save($author);
                }
            }
            DB::commit();
            return response()->json($book, 201);
        }
        catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving book failed: " . $e->getMessage(), 420);
        }
    }

    private function parseRequest(Request $request) : Request {

        $date = new \DateTime($request->published);
        $request['published'] = $date;
        return $request;
    }
    public function update(Request $request, string $isbn): JsonResponse {
        DB::beginTransaction();
        try {
            $book = Book::with(['authors', 'images', 'user'])
                ->where('isbn', $isbn)->first();
            if ($book != null) {
                $request = $this->parseRequest($request);
                $book->update($request->all());


                $book->images()->delete();
                if (isset($request['images']) && is_array($request['images'])) {
                    foreach ($request['images'] as $img) {
                        $image = Image::firstOrNew(['url'=>$img['url'],'title'=>$img['title']]);
                        $book->images()->save($image);
                    }
                }
                $ids = [];
                if (isset($request['authors']) && is_array($request['authors'])) {
                    foreach ($request['authors'] as $auth) {
                        array_push($ids,$auth['id']);
                    }
                }
                $book->authors()->sync($ids);
                $book->save();
            }
            DB::commit();

            return response()->json($book, 201);
        }
        catch (\Exception $e) {

            DB::rollBack();
            return response()->json("updating book failed: " . $e->getMessage(), 420);
        }
    }

    public function delete(string $isbn) : JsonResponse
    {
        $book = Book::where('isbn', $isbn)->first();
        if ($book != null) {
            $book->delete();
        }
        else
            throw new \Exception("book couldn't be deleted - it does not exist");
        return response()->json('book (' . $isbn . ') successfully deleted', 200);
    }
}