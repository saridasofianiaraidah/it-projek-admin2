<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['agent_id', 'item_id', 'quantity', 'unit_price', 'total_price', 'payment_method'];

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

