<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'rut',
        'type',
        'address',
        'phone',
        'email',
        'draft',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function scopeSearch($query, $search)
    {
        if ($search)
            return $query->orWhere('name', 'like', "%$search%")->orWhere('rut', 'like', "%$search%");
    }
}
