<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\contact;
use App\Models\Product;
use App\Models\Slider;

class HomeController extends Controller
{
    //
    public function index()
    {
        // $data = Slider::all();
        // $contact = contact::all();
        $products=Product::with('category')->active()->limit(8)->get();

        return response()->view('front.index',compact('products'));
    }
    public function ShowAllPorducts(){
        $products=Product::with('category')->active()->get();
        return response()->view('front.shop',compact('products'));
    }
    public function contact()
    {
        $contact = contact::all();
        return response()->view('front.contact',compact('contact'));
    }
    public function blog()
    {
        $blog = blog::all();
        return response()->view('front.blog',compact('blog'));
    }

}
