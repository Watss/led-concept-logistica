<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class BudgetStatus extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'color'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function Budgets()
    {
        return $this->hasMany(\App\Models\Budget::class);
    }

    public function scopeStatus($query,$value){

        switch ($value) {
            case 1:
                $query->whereIn('id',[1,3,4]);
            break;

            case 2:
                if (Auth::user()->isAdmin()) {

                    $query->whereIn('id',[2,3,4]);
                }else{

                    $query->whereIn('id',[2]);
                }
            break;

            case 3:
                $query->whereIn('id',[3,4,5]);
            break;

            case 4:
                $query->whereIn('id',[4,5]);
            break;

            case 5:
                $query->whereIn('id',[4,5]);
            break;

            default:
                # code... nose asjajs
            break;
        }


    }


}
