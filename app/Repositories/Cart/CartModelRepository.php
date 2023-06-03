<?php

namespace App\Repositories\Cart;

use App\Models\cart;
use App\Models\product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartModelRepository implements CartRepository
{

    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(): Collection
    {
        if (!$this->items->count()) {
            $this->items=cart::with('product')->get();
        }
        return $this->items;
    }

    public function add(product $product, $quantity = 1)
    {
        $item = cart::where('product_id', '=', $product->id)->first();
        if (!$item) {
             $cart= cart::create([
                'admin_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
            $this->get()->push($cart);
            return $cart;
        }
        return $item->increment('quantity', $quantity);
    }

    public function update($id, $quantity)
    {
        return cart::where('id', '=', $id)
            ->update([
                'quantity' => $quantity,
            ]);
    }
    public function delete($id)
    {
        cart::where('id', '=', $id)
            // ->where('cookie_id', '=', $this->getCookieId())
            ->delete();
    }
    public function empty()
    {
        cart::query()->delete();
    }
    // public function total(): float
    // {
    //     // return (float) cart::join('products', 'products.id', '=', 'carts.product_id')
    //     //     ->selectRaw('SUM("porducts.price * carts.quantity") as total')
    //     //     ->value('total');
    //      return $this->get()->sum(function($items){
    //         return $items->quantity * $items->product->price;
    //     });
    // }
}
