<?php

namespace App;

use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use SlugTrait;

    protected $fillable = [
        'name',
        'description',
        'slug',
    ];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }
}
