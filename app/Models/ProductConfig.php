<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductConfig extends Model
{
    use HasFactory;
    protected $fillable = ["sku_led_concept", "sku_led_center", "legacy_sku_led_concept", "legacy_sku_led_center", "descripcion", "proveedor"];

    public function reportSaleDetails()
    {
        return $this->hasMany(ReportSaleDetail::class);
    }

    public function reportStockDetails()
    {
        return $this->hasMany(ReportStockDetail::class);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('descripcion', 'LIKE', '%' . $value . '%')->orWhere('sku_led_concept', 'LIKE', '%' . $value . '%')->orWhere('sku_led_center', 'LIKE', '%' . $value . '%')->orWhere('legacy_sku_led_concept', 'LIKE', '%' . $value . '%')->orWhere('legacy_sku_led_center', 'LIKE', '%' . $value . '%')->orWhere('proveedor', 'LIKE', '%' . $value . '%');
    }
}
