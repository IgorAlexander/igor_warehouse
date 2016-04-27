<?php

namespace App\Repositories;

use App\User;
use App\Item;

class ItemRepository
{
	public function forCategory($id)
	{
		return Item::where('category_id', $id)
					->orderBy('created_at','asc')
					->get();
	}
}
