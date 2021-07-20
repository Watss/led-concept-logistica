<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'barcode',
        'brand_id',
        'temporary',
        'price',
        'status',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'temporary' => 'boolean',
        'price' => 'double',
        'status' => 'boolean',
    ];


    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class);
    }

    public function detailsBudgets()
    {
        return $this->hasMany(\App\Models\DetailsBudget::class);
    }
}
