<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportStockDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'code',
        'product_config_id',
        'report_id',
        'company_id',
        'offices_details',
    ];

    protected $casts = [
        'offices_details' => 'array',
    ];

    // Relaciones con otros modelos

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class)->withTrashed();
    }

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
