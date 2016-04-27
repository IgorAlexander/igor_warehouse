<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metric extends Model
{
	protected $table ='metrics';

    protected $fillable = ['name', 'symbol'];
    //

    public function items()
    {
    	return $this->hasMany('App\Item', 'metric_id', 'id');
    }

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
}
