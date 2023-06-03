<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(CartRepository $cart)
    {
        //
        return view('front.cart',['cart'=>$cart]);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,CartRepository $cart)
    {
        //
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','integer','min:1'],

        ]);
        $product=product::findOrFail($request->post('product_id'));

        $cart->add($product,$request->post('quantity'));
        return redirect()->route('carts.index')->with('success','Product Added Successfuly');


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,CartRepository $cart)
    {
        //
        $request->validate([
            'product_id'=>['required','int','exists:products,id'],
            'quantity'=>['nullable','integer','min:1'],

        ]);
        $product=product::findOrFail($request->post('product_id'));

        $cart->update($product,$request->post('quantity'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartRepository $cart, string $id)
    {
        //
        //الطريقة الاولى
        // $repository= new CartModelRepository();
        //الطريقة الثانية
        $cart->delete($id);
        return redirect()->back();
    }
}
