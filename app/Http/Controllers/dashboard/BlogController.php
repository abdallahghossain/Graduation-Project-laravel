<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = blog::all();
        return response()->view('dashboard.blog.index', ['blog' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:4|max:50',
            'description' => 'required|string|min:4|max:150',
        //    'image' => 'required|image|mimes:jpg,png,jpeg|max:3025',
        ]);

        $data = new blog();
        $data->name = $request->input('name');
        $data->url = $request->input('url');
        $data->date = $request->input('data');
        $data->description = $request->input('description');
        if($request->hasFile('image')){
            $file=$request->file('image');
            $path=$file->store('uploads',[
                'disk'=>'public',
            ]);
            $data['image']=$path;
        }
        $saved = $data->save();
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
        $data = blog::find($id);
        return response()->view('dashboard.blog.edit' , ['data' => $data]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = blog::find($id);
        $data->name = $request->input('name');
        $data->url = $request->input('url');
        $data->date = $request->input('data');
        $data->description = $request->input('description');
        if($request->hasFile('image')){
            $file=$request->file('image');
            $path=$file->store('uploads',[
                'disk'=>'public',
            ]);
            $data['image']=$path;
        }
        $saved = $data->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleteCount = blog::destroy($id);
        return redirect()->back();
    }
}
