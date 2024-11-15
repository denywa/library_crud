<?php

namespace App\Http\Controllers;

//import model User
use App\Models\User;

//import return type View
use Illuminate\View\View;

//import return type RedirectResponse
use Illuminate\Http\RedirectResponse;

//import Http Request
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get all users
        $users = User::latest()->paginate(10);

        //render view with users
        return view('users.index', compact('users'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('users.create');
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
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        //create user
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'User Berhasil Disimpan!']);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get user by ID
        $user = User::findOrFail($id);

        //render view with user
        return view('users.show', compact('user'));
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get user by ID
        $user = User::findOrFail($id);

        //render view with user
        return view('users.edit', compact('user'));
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
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6'
        ]);

        //get user by ID
        $user = User::findOrFail($id);

        //update user
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password
        ]);

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'User Berhasil Diubah!']);
    }

    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get user by ID
        $user = User::findOrFail($id);

        //delete user
        $user->delete();

        //redirect to index
        return redirect()->route('users.index')->with(['success' => 'User Berhasil Dihapus!']);
    }
}
