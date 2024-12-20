<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Laravel\Scout\Searchable;

class OrderAddress extends Model
{
    use HasFactory;
    use Searchable;
    protected $table = 'shop_order_addresses';

    /** @return MorphTo<Model,self> */
    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
