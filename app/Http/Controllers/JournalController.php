<?php

namespace App\Http\Controllers;

//import model Journal
use App\Models\Journal; 

//import return type View
use Illuminate\View\View;

//import return type RedirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;

class JournalController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get all journals
        $journals = Journal::latest()->paginate(10);

        //render view with journals
        return view('journals.index', compact('journals'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('journals.create');
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
            'publication_year'  => 'required|numeric|max:' . date('Y')
        ]);

        //create journal
        Journal::create([
            'title'             => $request->title,
            'author'            => $request->author,
            'publisher'         => $request->publisher,
            'publication_year'  => $request->publication_year
        ]);

        //redirect to index
        return redirect()->route('journals.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get journal by ID
        $journal = Journal::findOrFail($id);

        //render view with journal
        return view('journals.show', compact('journal'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get journal by ID
        $journal = Journal::findOrFail($id);

        //render view with journal
        return view('journals.edit', compact('journal'));
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
            'publication_year'  => 'required|numeric|max:' . date('Y')
        ]);

        //get journal by ID
        $journal = Journal::findOrFail($id);

        //update journal
        $journal->update([
            'title'             => $request->title,
            'author'            => $request->author,
            'publisher'         => $request->publisher,
            'publication_year'  => $request->publication_year
        ]);

        //redirect to index
        return redirect()->route('journals.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get journal by ID
        $journal = Journal::findOrFail($id);

        //delete journal
        $journal->delete();

        //redirect to index
        return redirect()->route('journals.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
