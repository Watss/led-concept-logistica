<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['start', 'end', 'user_id'];

    // Relación con el modelo de usuario
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function reportSaleDetails()
    {
        return $this->hasMany(ReportSaleDetail::class);
    }

    public function reportStockDetails()
    {
        return $this->hasMany(ReportStockDetail::class);
    }
}
