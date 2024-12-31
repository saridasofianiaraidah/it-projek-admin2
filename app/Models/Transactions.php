<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'agent_id',
        'category_id',
        'item_name',
        'item_image',
        'netto',
        'unit',
        'unit_price',
        'quantity',
        'discount',
        'purchase_date',
        'total_price',
        'payment_method',
    ];

    // Relasi dengan model Agent
    public function agent()
    {
        return $this->belongsTo(Agent::class, 'agent_id');
    }

    // Relasi dengan model Item (jika transaksi memiliki banyak barang)
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // Relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
