<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('pages.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $roles=Role::all();
         return view('pages.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;

        $uploadedPhotos = [];

        // Check if 'photo' is an array of files
        if ($request->hasFile('photo')) {
            $photos = $request->file('photo');
            if (is_array($photos)) {
                foreach ($photos as $file) {
                    $photoname = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('photo'), $photoname);
                    $uploadedPhotos[] = $photoname;
                }
            }
        }

        $user->photo = !empty($uploadedPhotos) ? implode(',', $uploadedPhotos) : null;

        if ($user->save()) {
            return redirect('users')->with('success', "User has been registered");
        } else {
            return back()->with('error', 'Something went wrong.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
