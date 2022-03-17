<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\BooksResource;
use App\Http\Requests\BooksStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use \Illuminate\Http\Response;
use App\Models\Book;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BooksResource::collection(Book::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksStoreRequest $request)
    {
        $picName = time().'.'.$request->img->extension();
        $request->img->move(public_path('uploads'),$picName);

        $created_book = Book::create(array_merge($request->validated(), ['img'=>'//project/public/uploads/' . $picName]));

        return new BooksResource($created_book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new BooksResource(Book::with('authors')->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BooksStoreRequest $request, Book $book)
    {
        if($request->hasFile('image')){
            
            $picName = time().'.'.$request->img->extension();
            $request->img->move(public_path('uploads'),$picName);
            $book -> update(array_merge($request->validated(),['img'=>'//project/public/uploads/' . $picName]));
            return $book;
        } else {
               $book -> update($request->validated());
               return $book; 
        }

        
        
        
        
        
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response(null,Response::HTTP_NO_CONTENT);
    }
}
