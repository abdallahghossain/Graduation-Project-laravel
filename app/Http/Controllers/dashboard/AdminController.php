<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $admins=admin::paginate(8);
        return response()->view('dashboard.admins.index',compact('admins'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:4|max:50',
            'mobile' => 'required|digits:10|unique:admins,id|numeric',
            'email' => 'required|unique:admins,email',
            'address' => 'required|string|min:5|max:150',
            // 'image' => 'required|image|mimes:jpg,png,jpeg|max:3025',
            'status' => 'nullable|string|in:active,archived',
            'password' => [
                'required', 'string',
                // Password::min(5)->letters()
                // ->mixedCase()->symbols()->uncompromised(),
            ],
        ]);
        $admin = new admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->address = $request->input('address');
        $admin->mobile = $request->input('mobile');
        $admin->password = Hash::make($request->input('password'));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            $data['image'] = $path;
         $admin->image =$data['image'];
        }
        $admin->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $admin=admin::findOrFail($id);
        return view('dashboard.admins.edit',compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, admin $admin)
    {
        //
        $request->validate([
            'name' => 'required|string|min:4|max:50',
            'mobile' => 'required|digits:10|unique:admin$admins,id|numeric',
            'email' => 'required|unique:complaints,email',
            'address' => 'required|string|min:5|max:150',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:3025',
            'status' => 'nullable|string|in:active,archived',
               'password' => [
                'required', 'string',Password::min(5)->letters()
                // ->mixedCase()->symbols()->uncompromised(),
            ],
        ]);
        $admin = new admin();
        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->address = $request->input('address');
        $admin->password = Hash::make($request->input('password'));
        if($request->hasFile('image')){
            $file=$request->file('image');
            $path=$file->store('uploads',[
                'disk'=>'public',
            ]);
            $data['image']=$path;
        }
        $saved=$admin->save();
        return redirect()->route('admins.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(admin $admin)
    {
        //
    }
}
