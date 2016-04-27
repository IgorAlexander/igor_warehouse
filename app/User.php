<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'is_admin', 'approved'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function metrics()
    {
        return $this->hasMany('App\Metric', 'user_id', 'id');
    }

    public function items()
    {
        return $this->hasMany('App\Item', 'user_id', 'id');
    }

    public function item_stock_movements()
    {
        return $this->hasMany('App\ItemStockMovements', 'user_id', 'id');
    }

    public function isAdmin(){
        return $this->is_admin;
    }

    public function isApproved(){
        return $this->approved;
    }
}
