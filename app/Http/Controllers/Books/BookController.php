<?php

namespace App\Http\Controllers\Books;

use App\Book;
use App\BooksRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class BookController extends Controller
{
    /** @var BooksRepository */
    private $books;

    const googleUrl = 'https://www.googleapis.com/books/v1/volumes?q=%s&key=%s';
    const validCategories = [
        'fiction',
        'juvenile fiction',
        'biography & autobiography',
        'comics & graphic novels'
    ];

    public function __construct(BooksRepository $books)
    {
        $this->books = $books;
    }

    public function index()
    {
        return Book::all();
    }

    public function search(Request $request)
    {
        if ($request->get('term') == '') {
            return [];
        }

        $books = $this->books->search($request->get('term'));

        $localBooks = collect($books['hits']['hits'])->map(function($book){
            return [
                'id' => $book['_id'],
                'title' => $book['_source']['title'],
                'author' => $book['_source']['author'],
                'source' => 'local'
            ];
        });

        if ($localBooks->isEmpty()) {
            $googleData = json_decode($this->googleSearch($request->get('term')), true);

            return collect($googleData['items'])->filter(function($book){
                $categories = $book['volumeInfo']['categories'] ?? [];

                /** @var Collection $categories */
                $categories = collect($categories);

                if ($book['volumeInfo']['subtitle'] ?? '' == 'Study Guide') {
                    return false;
                }

                if (!empty($categories) &&
                    count($categories) == 1 &&
                    !in_array(strtolower($categories[0]), self::validCategories) ){
                        return false;
                }

                if ($categories->contains('Nonfiction') ||
                    $categories->contains('Juvenile Nonfiction') ||
                    $categories->contains('Literary Criticism')) {
                    return false;
                }

                $isbn = collect($book['volumeInfo']['industryIdentifiers'])->filter(function($isbn){
                    return $isbn['type'] == "ISBN_13";
                })->reduce(function($carry, $isbn){
                    return $isbn['identifier'];
                });

                if (!$isbn) {
                    return false;
                }

                if (!isset($book['volumeInfo']['authors'])) {
                    return false;
                }

               return true;
            })->map(function($book){
                $isbn = collect($book['volumeInfo']['industryIdentifiers'])->filter(function($isbn){
                    return $isbn['type'] == "ISBN_13";
                })->reduce(function($carry, $isbn){
                    return $isbn['identifier'];
                });

                return [
                    'id' => $isbn,
                    'title' => $book['volumeInfo']['title'],
                    'author' => implode($book['volumeInfo']['authors'], ', '),
                    'source' => 'google'
                ];
            })->unique(function ($item) {
                return $item['title'].'-'.$item['author'];
            })->sortBy('title')->values();

        }

        return $localBooks->sortBy('title')->values();
    }


    private function googleSearch($search)
    {
        $s = curl_init();

        $url = sprintf(
            self::googleUrl,
            str_replace(' ', '+', $search),
            config('auth.google_api_key')
        );

        curl_setopt($s,CURLOPT_URL, $url);
        curl_setopt($s, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($s, CURLOPT_ENCODING, "gzip");
        curl_setopt($s, CURLOPT_USERAGENT, "Bookup (gzip)");

        return curl_exec($s);
    }




}