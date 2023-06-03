<?php

namespace App\Models;

use App\Observers\CartObserver;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class cart extends Model
{
    use HasFactory;
    public $incrementing=false;

    protected $fillable=[
        'cookie_id','admin_id','product_id','quantity','options'
    ];

    //events (Obsrever)
    // creating,created,updating ,updated,saving,saved
    //deleting ,deleted,restoring,restored,retrieved

    protected static function booted()
    {
       static::observe(CartObserver::class);
       static::addGlobalScope('cookie_id',function(Builder $builder){
        $builder->where('cookie_id', '=', Cart::getCookieId());
       });

    }
    public static function getCookieId()
    {
        $cookie_id = Cookie::get('cart_id');
        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 30 * 24 * 60);
        }
        return $cookie_id;
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault([
            'name'=>'anonymous',
        ]);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }



}

