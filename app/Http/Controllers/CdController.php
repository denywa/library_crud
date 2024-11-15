<?php

namespace App\Http\Controllers;

use App\Models\Cd;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CdController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get all cds
        $cds = Cd::latest()->paginate(10);

        //render view with cds
        return view('cds.index', compact('cds'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('cds.create');
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
            'title'        => 'required|min:5',
            'artist'       => 'required|min:3',
            'release_year' => 'required|numeric|max:' . date('Y')
        ]);

        //create cd
        Cd::create([
            'title'        => $request->title,
            'artist'       => $request->artist,
            'release_year' => $request->release_year
        ]);

        //redirect to index
        return redirect()->route('cds.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get cd by ID
        $cd = Cd::findOrFail($id);

        //render view with cd
        return view('cds.show', compact('cd'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get cd by ID
        $cd = Cd::findOrFail($id);

        //render view with cd
        return view('cds.edit', compact('cd'));
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
            'title'        => 'required|min:5',
            'artist'       => 'required|min:3',
            'release_year' => 'required|numeric|max:' . date('Y')
        ]);

        //get cd by ID
        $cd = Cd::findOrFail($id);

        //update cd
        $cd->update([
            'title'        => $request->title,
            'artist'       => $request->artist,
            'release_year' => $request->release_year
        ]);

        //redirect to index
        return redirect()->route('cds.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get cd by ID
        $cd = Cd::findOrFail($id);

        //delete cd
        $cd->delete();

        //redirect to index
        return redirect()->route('cds.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
