<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function show(Product $product)
    {
        //
        if (!$product->status == "active" ) {
            abort(403);
        }
        return view('front.single-product',compact('product'));

    }

}
