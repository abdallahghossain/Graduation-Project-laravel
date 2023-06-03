<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductValidate;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $products = Product::with('category')->paginate(8);
        return response()->view('dashboard.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $parents = Product::all();
        return response()->view('dashboard.products.create',compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductValidate $request)
    {
        //
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            $data['image'] = $path;
        }
        Product::create($data);
        return redirect()->route('products.index')->with('success', 'product created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        return view('dashboard.products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $product = product::findOrFail($id);
        return response()->view('dashboard.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
          'name' => [
                    'required', 'string', 'min:3', 'max:255'
                ],
                'price' => [
                    'required','numeric','min:0'
                ],
                'compare_price' => [
                    'required','numeric','min:0'
                ],
                'description' => [
                    'nullable', 'string', 'min:5', 'max:200'
                ],
                'status' => 'required|in:active,draft,archived',
        ]);

        $product = product::findOrFail($id);
        // $product->name = $request->input('name');
        // $product->description = $request->input('description');
        // $product->price = $request->input('price');
        // $product->compare_price = $request->input('compare_price');
        // $product->status = $request->input('status');
        // $old_image = $product->image;
        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $path = $file->store('uploads', [
        //         'disk' => 'public',
        //     ]);
        //     $data['image'] = $path;
        // }
        // $product->save();
        $old_image = $product->image;
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads', [
                'disk' => 'public',
            ]);
            $data['image'] = $path;
        }
        $product->update($data);
        if ($old_image && isset($data['image'])) {
            Storage::disk('public')->delete($old_image);
        }
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $product=Product::findOrFail($id);
        $product->delete();
         return redirect()->back()->with('success', 'Product Deleted!');
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->paginate();
        return response()->view('dashboard.products.trash', ['products' => $products]);
    }
    public function restore($id)
    {
        $Product = Product::onlyTrashed()->findOrFail($id);
        $Product->restore();
        return redirect()->back();
    }
    public function forceDelete($id)
    {
        $Product = Product::onlyTrashed()->findOrFail($id);
        $Product->forceDelete();
        if ($Product->image) {
            Storage::disk('public')->delete($Product->image);
        }
        return redirect()->route('products.trash');
    }
}
