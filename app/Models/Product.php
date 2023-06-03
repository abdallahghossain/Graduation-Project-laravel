<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name', 'descrption', 'category_id', 'image',
        'price', 'compare_price', 'status'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function scopeActive(Builder $builder)
    {
        $builder->where('status', '=', 'active');
    }
    public function getSalePercentAttribute()
    {
        if (!$this->compar_price) {
            return 0;
        }
        return round(100 - (100* $this->price  / $this->compare_price),1);
    }
}
