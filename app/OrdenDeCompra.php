<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenDeCompra extends Model
{
    //
    protected $table = 'orden_de_compra';

	protected $fillable = [
		'item_id',
		'user_id',
		'cost',
		'cant'		
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
}
