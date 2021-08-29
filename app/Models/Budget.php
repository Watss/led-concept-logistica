<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getNetoAttribute($value)
    {
        return "$ " . number_format($value, 0, ',', '.');
    }

    public function getIvaAttribute($value)
    {
        return "$ " . number_format($value, 0, ',', '.');
    }
    public function getTotalAttribute($value)
    {
        return "$ " . number_format($value, 0, ',', '.');
    }


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


    public function scopeDates($query, $values)
    {
        foreach ($values as $key => $value) {
            if ($key == 0) {
                $values[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $value . '00:00:00')->toDateTimeString();

            } else {
                $values[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $value . '23:59:59')->toDateTimeString();
            }
        }

        $query->whereBetween('created_at', $values);
    }
}
