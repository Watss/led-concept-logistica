<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogUpdateProductPrice extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'prices_updated', 'products_matched', 'products_actually_price'];
}
