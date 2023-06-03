<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $user = User::Paginate(5);
        return response()->view('dashboard.users.index', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:4|max:50',
            // 'mobile' => 'required|digits:10|unique:users,id|numeric',
            'email' => 'required|unique:users,email',
            'address' => 'required|string|min:5|max:150',
            // 'image' => 'required|image|mimes:jpg,png,jpeg|max:3025',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'password' => [
                'required', 'string', Password::min(5)
                // ->letters()
                // ->mixedCase()->symbols()->uncompromised(),
            ],
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->password = Hash::make($request->input('password'));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            $data['image'] = $path;
        $user->image =$data['image'];

        }
        $user->save();
        return redirect()->back();
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
        $user = DB::table('users')->where('id', '=', $id)->first();
        return response()->view('dashboard.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3|max:40',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => [
                'required', 'string',
                Password::min(5)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'mobile' => 'required|digits:10|unique:users,id|numeric',
            'address' => 'nullable|string|min:3|max:50'
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->password = Hash::make($request->input('password'));
        $saved = $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $user = User::findOrFail($id);
        $deleted = $user->delete();
        return redirect()->back();
    }
}
