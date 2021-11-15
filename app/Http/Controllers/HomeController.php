<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function getBooks()
    {
        $response = Http::withHeaders([
            'Authorization' => 'AppRinger',
        ])->get('https://run.mocky.io/v3/821d47eb-b962-4a30-9231-e54479f1fbdf');

        $books = $response->object()->items;
        return $books;
    }
    public function index()
    {
        $books = $this->getBooks();
        return view('home',compact('books'));
    }

    public function fetchData()
    {
        $books = $this->getBooks();
        
        foreach($books as $book) 
        {
            $id = $book->id;
            $check_book = Book::where('id',$id)->first();
            if (empty($check_book)) 
            {
                $smallThumbnail = isset($book->volumeInfo->imageLinks->smallThumbnail) ? $book->volumeInfo->imageLinks->smallThumbnail : '';
                $thumbnail      = isset($book->volumeInfo->imageLinks->thumbnail) ? $book->volumeInfo->imageLinks->thumbnail : '';
                $title          = isset($book->volumeInfo->title) ? $book->volumeInfo->title : '';
                $subtitle       = isset($book->volumeInfo->subtitle) ? $book->volumeInfo->subtitle : '';
                $authors        = isset($book->volumeInfo->authors) ? $book->volumeInfo->authors : '';
                if (is_array($authors)) 
                {
                    $authors = implode(",",$authors);
                }

                $add_book = Book::create([
                    'id'                => $id,
                    'smallThumbnail'    => $smallThumbnail,
                    'thumbnail'         => $thumbnail,
                    'title'             => $title,
                    'subtitle'          => $subtitle,
                    'authors'           => $authors,
                ]);
            }
        }
        echo "Books added successfully";
        die();
    }
}
