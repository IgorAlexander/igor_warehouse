<?php

namespace App\Http\Controllers;

use App\Item;
use App\Category;
use App\Metric;
use App\OrdenDeCompra;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ItemRepository;

class ItemController extends Controller
{
	protected $items, $categories, $metrics, $ocs;
    //
    public function __construct(ItemRepository $items)
    {
    	$this->middleware('auth');

    	$this->items = $items;
    	$this->categories = Category::orderBy('name','asc')
						->get();
		$this->metrics = Metric::orderBy('name','asc')
						->get();
        $this->ocs = OrdenDeCompra::orderBy('id','asc')
                        ->get();



                /*
        Category::create([
            'name' => 'Electronica',
            ]);
        Category::create([
            'name' => 'Bebidas',
            ]);
        Category::create([
            'name' => 'Manufactura',
            ]);
        Category::create([
            'name' => 'Minerales',
            ]);
        Category::create([
            'name' => 'Manufactura',
            ]);
        Category::create([
            'name' => 'Drogas',
            ]);
        Metric::create([
            'name' => 'Litros',
            'symbol' => 'L'
            ]);

        Metric::create([
            'name' => 'Metros',
            'symbol' => 'M'
            ]);

        Metric::create([
            'name' => 'Metros cubicos',
            'symbol' => 'M3'
            ]);

        Metric::create([
            'name' => 'Kilogramos',
            'symbol' => 'Kg'
            ]);
    */
    }

    public function index(Request $request)
    {
    	return view('warehouse.inventory', [
            //Nunca habra una categoria con id = 0, por lo que es lista vacia
            'items' => $this->items->forCategory(0),
    		'categories' => $this->categories,
    		]);
    }

    public function selectCat(Request $request)
    {
    	return view('warehouse.inventory', [
    		'items' => $this->items->forCategory($request->id_cat),
    		'categories' => $this->categories,
    		]);
    }

    public function addStock(Request $request, Item $item)
    {
    	return view('warehouse.addStock', [
    		'item' => $item,
    		]);
    }

    public function takeStock(Request $request, Item $item)
    {
    	return view('warehouse.takeStock', [
    		'item' => $item,
    		]);
    }

    public function formAddItem(Request $request)
    {
    	return view('warehouse.addItem', [
    		'categories' => $this->categories,
    		'metrics' => $this->metrics,
    		]);
    }

    public function storeItem(Request $request)
    {
    	/*$this->validate($request, [
    		'name' => 'required|max:255',
    	]);*/
    	Item::create([
    		'name' => $request->nombre,
    		'category_id' => $request->id_cat,
    		'user_id' => $request->user()->id,
    		'metric_id' => $request->id_met,
    		'quantity' => 0,
    		'description' => $request->desc
    		]);
    	return redirect('/inventory');
    }

    public function storeOC(Request $request, Item $item)
    {
        /*$this->validate($request, [
            'name' => 'required|max:255',
        ]);*/
        OrdenDeCompra::create([
            'item_id' => $item->id,
            'user_id' => $request->user()->id,
            'cant' => $request->cant,
            'cost' => $request->costo
            ]);
        return redirect('/inventory');
    }

    public function storeOV(Request $request, Item $item)
    {
        $item->take($request->cant, 'OV', $request->costo);    
        return redirect('/inventory');
    }

    public function getOC(Request $request)
    {
        return view('warehouse.oc', [
            'ocs' => $this->ocs
            ]);
    }

    public function approveOC(Request $request, OrdenDeCompra $oc)
    {
        $item = Item::where('id', $oc->item_id)->first();
        $item->add($oc->cant, 'OC', $oc->cost);                
        $oc->approved = true;
        $oc->save();
        return redirect('/admin/oc');
    }
}

