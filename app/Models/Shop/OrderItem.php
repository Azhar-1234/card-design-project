<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
class OrderItem extends Model
{
    use HasFactory;
    use Searchable;
    /**
     * @var string
     */
    protected $table = 'shop_order_items';
}
