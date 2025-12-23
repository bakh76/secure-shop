<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status',
        'total',
        'payment_method',
        'payment_status',
        'shipping_address',
    ];

    // Relationship: An order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship: An order has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}