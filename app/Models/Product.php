<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;
use App\Models\Type;
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
        'image',
        'type_id'
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

    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class);
    }

    public function detailsBudgets()
    {
        return $this->hasMany(\App\Models\DetailsBudget::class);
    }

    public function scopeSearch($query, $search)
    {
        if ($search)
            return $query->orWhere('name', 'like', "%$search%")->orWhere('sku', 'like', "%$search%");
    }

    public function scopeActive($query){

        $query->where('status',1);
    }
    
    public function scopeTemporary($query, $value){
        if ($value != null)
            return $query->where('temporary','=',$value);
    }
}
