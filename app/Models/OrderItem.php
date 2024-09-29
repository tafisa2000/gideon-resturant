<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = 
    [
        'order_id',
        'menu_item_id',
        'modifier_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);

    }



    public function modifiers()
    {
        return $this->belongsToMany(Modifier::class, 'order_modifiers');
    }
}
