<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model // Ubah nama menjadi singular "Transaction"
{
    use HasFactory;

    // Mass assignable attributes
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

    // Relasi ke model Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    // Relasi ke model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
