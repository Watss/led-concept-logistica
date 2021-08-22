<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected  $appends = [
        "rolesUser",
    ];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'area'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRolesUserAttribute()
    {
        return implode(",", $this->roles->pluck('name')->toArray());
    }

    public function scopeSearch(Builder $query, $value)
    {

        if ($value)
            return $query->orWhere('name', 'like', "%$value%")
                ->orWhere('email', 'like', "%$value%")
                ->orWhere('area', 'like', "%$value%")
                ->orWhereHas('roles', function ($q) use ($value) {
                    $q->where('name', 'LIKE', "%$value%");
                });
    }


    public function isAdmin(){

        return $this->hasRole(['Administrador']);
    }


}
