<?php

namespace App\Http\Controllers;

//import model Book
use App\Models\Book; 

//import return type View
use Illuminate\View\View;

//import return type RedirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;

//import Storage facade
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get all books
        $books = Book::latest()->paginate(10);

        //render view with books
        return view('books.index', compact('books'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('books.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'title'             => 'required|min:5',
            'author'            => 'required|min:3',
            'publisher'         => 'required|min:3',
            'publication_year'  => 'required|numeric|max:' . date('Y'),
            'type'              => 'required|in:physical,e-book'
        ]);

        //create book
        Book::create([
            'title'             => $request->title,
            'author'            => $request->author,
            'publisher'         => $request->publisher,
            'publication_year'  => $request->publication_year,
            'type'              => $request->type
        ]);

        //redirect to index
        return redirect()->route('books.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get book by ID
        $book = Book::findOrFail($id);

        //render view with book
        return view('books.show', compact('book'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get book by ID
        $book = Book::findOrFail($id);

        //render view with book
        return view('books.edit', compact('book'));
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'title'             => 'required|min:5',
            'author'            => 'required|min:3',
            'publisher'         => 'required|min:3',
            'publication_year'  => 'required|numeric|max:' . date('Y'),
            'type'              => 'required|in:physical,e-book'
        ]);

        //get book by ID
        $book = Book::findOrFail($id);

        //update book
        $book->update([
            'title'             => $request->title,
            'author'            => $request->author,
            'publisher'         => $request->publisher,
            'publication_year'  => $request->publication_year,
            'type'              => $request->type
        ]);

        //redirect to index
        return redirect()->route('books.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get book by ID
        $book = Book::findOrFail($id);

        //delete book
        $book->delete();

        //redirect to index
        return redirect()->route('books.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
