<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    //DATA AND RELATIONSHIPS

	protected $table = 'items';
    //
    protected $fillable = [
    	'user_id',
    	'category_id',
    	'metric_id',
    	'name',
    	'description',
    	'quantity',
    ];

    public function category()
    {
    	return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function metric()
    {
    	return $this->hasOne('App\Metric', 'id', 'metric_id');
    }

    public function user()
    {
    	return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function movements()
    {
    	return $this->hasMany('App\ItemStockMovements', 'item_id', 'id');
    }

    //FUNCTIONS

    public function getTotalStock()
    {
        return $this->quantity;
    }

    public function hasMetric()
    {
        if ($this->metric){
            return true;
        }
        return false;
    }

    public function hasCategory()
    {
        if ($this->category){
            return true;
        }
        return false;
    }

    public function getMetricSymbol()
    {
        if ($this->hasMetric()){
            return $this->metric->symbol;
        }
        return;
    }

    public function isInStock()
    {
        if ($this->getTotalStock() > 0){
            return true;
        }
        return false;
    }

    public function hasEnoughStock($cant = 0)
    {
        if ($this->quantity >= $cant) {
            return true;
        }
        return false;
    }

    public function take($cant, $reason = '', $cost = 0)
    {
        if ($cant > 0 && $this->hasEnoughStock($cant)){
            $after = $this->quantity - $cant;
            $before = $this->quantity;


            $this->quantity = $after;
            $this->genStockMovement($before, $after, $reason, $cost);
            $this->save();

        }
    }

    public function add($cant, $reason = '', $cost = 0)
    {
        if ($cant > 0){
            $after = $this->quantity + $cant;
            $before = $this->quantity;


            $this->quantity = $after;
            $this->genStockMovement($before, $after, $reason, $cost);
            $this->save();

        }
    }








    private function genStockMovement($before, $after, $reason = '', $cost = 0)
    {
        $insert = [
            'item_id' => $this->getKey(),
            'before' => $before,
            'after' => $after,
            'reason' => $reason,
            'cost' => $cost,
        ];

        return $this->movements()->create($insert);
    }



}
