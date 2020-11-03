<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use App\Notifications\StoreReceiveNewOrder;
use App\Traits\SlugTrait;

class Store extends Model
{
    use SlugTrait;

    protected $table = 'stores'; // Esta definicão vem definida, isso esta ai apenas pra facilitar minha visualizaçao mental

    protected $fillable = [
        'name',
        'description',
        'phone',
        'mobile_phone',
        'slug',
        'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    function notifyStoreOwners(array $storesId = [])
    {
        $stores = $this->whereIn('id', $storesId)->get();

        return $stores->map(
            function ($store) {
                return $store->user;
            }
        )->each->notify(new StoreReceiveNewOrder());
    }
}
