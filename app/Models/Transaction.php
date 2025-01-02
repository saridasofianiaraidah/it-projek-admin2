<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'item_name',
        'item_image',
        'netto',
        'unit',
        'category_id',
        'unit_price',
        'quantity',
        'discount',
        'total_price',
        'purchase_date',
        'payment_method',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function items()
{
    return $this->belongsToMany(Item::class, 'transaction_item', 'transaction_id', 'item_id')
                ->withPivot('quantity', 'unit_price', 'total_price');
}
}

