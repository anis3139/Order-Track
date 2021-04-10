<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_mobile',
        'customer_address',
        'parcel_type',
        'status',
        'order_date',
        'courier_company_name_id',
        'users_id',
        'orderProducts',
    ];

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }

}
