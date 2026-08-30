<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['order_id', 'full_name', 'whatsapp_number', 'full_address', 'pickup_point', 'delivery_note'])]
class ShippingDetail extends Model
{
    use HasFactory, HasUuids;

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
