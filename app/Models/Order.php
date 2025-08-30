<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'status',
    ];

    // Relation: Order has many items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Optional: Customer relation
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customer_name()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

}
