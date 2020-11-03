<?php

namespace App;

use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SlugTrait;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'body',
        'price',
        'slug',
    ];

    public function getThumbAttribute()
    {
        return $this->photos->first()->image;
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
   
    // Recupera da Database (Database -> Frontend)
    public function getPriceAttribute()
    {
        return number_format($this->attributes['price'], 2, ',', '.');
    }

    // Conversor de formnato de moedas. (FrontEnd -> Database)
    public function setPriceAttribute($value)
    {
        $value = str_replace(['.', ','], ['', '.'], $value);
        settype($value, "float");
        $this->attributes['price'] = $value;
    }
}
