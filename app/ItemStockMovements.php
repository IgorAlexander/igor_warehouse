<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemStockMovements extends Model
{
	protected $table = 'item_stock_movements';

	protected $fillable = [
		'item_id',
		'user_id',
		'before',
		'after',
		'cost',
		'reason'
	];
    //

    public function item()
    {
    	return $this->belongsTo('App\Item', 'item_id', 'id');
    }

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }


    //FUNCTIONS

    

}


