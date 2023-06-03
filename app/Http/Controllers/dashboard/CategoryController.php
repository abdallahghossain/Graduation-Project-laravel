<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $categories = category::withCount('products')->paginate(8);


        return response()->view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = category::all();
        return response()->view('dashboard.categories.create', ['parents' => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required', 'string', 'min:3', 'max:255',
            ],
            'description' => [
                'nullable', 'string', 'min:5', 'max:200'
            ],
            // 'image' => [
            //     'mimes:png,jpg', 'max:3025'
            // ],
            'status' => 'in:active,archived',
        ]);

        $category = new category();
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            $data['image'] = $path;
        $category->image =$data['image'];
        }
        $category->status = $request->input('status');
        $category->save();
        return Redirect::route('categories.index')->with('success', 'Category created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(category $category)
    {
        //
        return view('dashboard.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        $category = category::findOrFail($id);
        return response()->view('dashboard.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => [
                'required', 'string', 'min:3', 'max:255',
            ],
            'description' => [
                'nullable', 'string', 'min:5', 'max:200'
            ],

            'status' => 'nullable|in:active,archived',
        ]);
        $category = category::findOrFail($id);

        // $category->name = $request->input('name');
        // $category->description = $request->input('description');
        // $category->status = $request->input('status');
        // $saved = $category->save();
        $old_image = $category->image;
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            $data['image'] = $path;
        }
        $category->update($data);
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }
    public function trash()
    {
        $categories = category::onlyTrashed()->paginate();
        return response()->view('dashboard.categories.trash', ['categories' => $categories]);
    }
    public function restore($id)
    {
        $category = category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('categories.index');
    }
    public function forceDelete($id)
    {
        $category = category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return redirect()->route('categories.trash');
    }
}
