<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'item_id',
        'quantity',
        'unit_price',
        'discount',
        'total_price',
        'payment_method',
    ];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function category()
{
    return $this->belongsTo(Category::class);
}

}
