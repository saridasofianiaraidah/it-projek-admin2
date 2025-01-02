<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'harga',
        'jumlah',
        'gambar',
        'category_id',
        'netto',
        'unit',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Model Item.php
public function transactions()
{
    return $this->belongsToMany(Transaction::class, 'transaction_item', 'item_id', 'transaction_id')
                ->withPivot('quantity', 'unit_price', 'total_price');
}

}
