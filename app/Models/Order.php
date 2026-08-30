<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['status', 'subtotal', 'ongkir', 'total_price'])]
class Order extends Model
{
    use HasFactory, HasUuids;

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:2',
            'ongkir' => 'decimal:2',
            'total_price' => 'decimal:2',
        ];
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function shipping()
    {
        return $this->hasOne(ShippingDetail::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
