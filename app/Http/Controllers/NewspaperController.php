<?php

namespace App\Http\Controllers;

use App\Models\Newspaper;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class NewspaperController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index() : View
    {
        //get all newspapers
        $newspapers = Newspaper::latest()->paginate(10);

        //render view with newspapers
        return view('newspapers.index', compact('newspapers'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('newspapers.create');
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
            'publisher'         => 'required|in:Kompas,Tribun Timur,Fajar',
            'publication_date'  => 'required|date|before_or_equal:' . date('Y-m-d')
        ]);

        //create newspaper
        Newspaper::create([
            'title'             => $request->title,
            'publisher'         => $request->publisher,
            'publication_date'  => $request->publication_date
        ]);

        //redirect to index
        return redirect()->route('newspapers.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get newspaper by ID
        $newspaper = Newspaper::findOrFail($id);

        //render view with newspaper
        return view('newspapers.show', compact('newspaper'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get newspaper by ID
        $newspaper = Newspaper::findOrFail($id);

        //render view with newspaper
        return view('newspapers.edit', compact('newspaper'));
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
            'publisher'         => 'required|in:Kompas,Tribun Timur,Fajar',
            'publication_date'  => 'required|date|before_or_equal:' . date('Y-m-d')
        ]);

        //get newspaper by ID
        $newspaper = Newspaper::findOrFail($id);

        //update newspaper
        $newspaper->update([
            'title'             => $request->title,
            'publisher'         => $request->publisher,
            'publication_date'  => $request->publication_date
        ]);

        //redirect to index
        return redirect()->route('newspapers.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get newspaper by ID
        $newspaper = Newspaper::findOrFail($id);

        //delete newspaper
        $newspaper->delete();

        //redirect to index
        return redirect()->route('newspapers.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
