<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailsBudget extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'budget_id',
        'quantity',
        'product_price',
        'product_sku',
        'total',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'product_id' => 'integer',
        'budget_id' => 'integer',
        'product_price' => 'double',
        'total' => 'double',
    ];


    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function budget()
    {
        return $this->belongsTo(\App\Models\Budget::class);
    }
}