<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected  $appends=[
        "netoAppends",
        "ivaAppends",
        "totalAppends",
     ];
    /**4
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
        'budget_statuses_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'neto' => 'double',
        'iva' => 'double',
        'total' => 'double',
        'client_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('Y-m-d');
    }

    public function getNetoAppendsAttribute()
    {
        return "$".number_format($this->neto,0,',','.');

    }
    public function getIvaAppendsAttribute()
    {
        return "$".number_format($this->iva,0,',','.');

    }
    public function getTotalAppendsAttribute()
    {
        return "$".number_format($this->total,0,',','.');
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

    public function status()
    {
        return $this->belongsTo(\App\Models\BudgetStatus::class, 'budget_statuses_id');
    }

    public function statusTrashed()
    {
        return $this->belongsTo(\App\Models\BudgetStatus::class, 'budget_statuses_id')->withTrashed();
    }


    public function scopeDates($query, $values)
    {
        try {
//no pude controlar la excepcion asi que dejare esto mientras D:
            foreach ($values as $key => $value) {
                if ($key == 0) {
                    $values[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $value . '00:00:00')->toDateTimeString();
                } else {
                    $values[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $value . '23:59:59')->toDateTimeString();
                }
            }

            $query->whereBetween('created_at', $values);
        } catch (\Throwable $th) {

        }


    }
    public function scopeStatus($query, $value)
    {
        if ($value) {
            $query->where('budget_statuses_id', $value);
        }
    }

    public function scopeSearch($query, $value)
    {
        if ($value)
            return $query->where('neto', 'LIKE', "%$value%")
                ->orWhere('iva', 'LIKE', "%$value%")
                ->orWhere('total', 'LIKE', "%$value%")
                ->orWhereHas('user', function ($q) use ($value) {
                    $q->where('name', 'LIKE', "%$value%");
                })->orWhereHas('client', function ($q) use ($value) {
                    $q->where('name', 'LIKE', "%$value%");
                });
    }
}
