<?php

namespace App\Containers\AppSection\Product\Models;

use App\Ship\Parents\Models\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $quantity
 * @property float $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Product extends Model
{
    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
    ];

    protected $fillable = [
        'name', 'description', 'quantity', 'price'
    ];
}
