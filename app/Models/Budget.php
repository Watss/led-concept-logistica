<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'neto',
        'iva',
        'total',
        'reference',
        'client_id',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'iva' => 'double',
        'client_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function detailsBudgets()
    {
        return $this->hasMany(\App\Models\DetailsBudget::class);
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
