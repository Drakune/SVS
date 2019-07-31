<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Shelfspace;
use App\ShelfKey;
use DB;

class MyController extends Controller {

    public function index() {

    	$shelf = Shelfspace::all();
    	$key = ShelfKey::all();
    	
    	return view('svs.index',compact('shelf','key'));
    }
    /*public function create() {
    	if(Shelfspace::all()->isEmpty() && Shelfspace::all()->isEmpty()) {
    		echo "Tables are empty => Rows will be created!<br>";
    		for ($i=1; $i <= 15; $i++) { 
    			DB::table('shelfspaces')->insert(array(
		            array('id'=>$i,'nummer'=>"SP$i",'created_at'=>now(),'updated_at'=>now())
				));
    		}
    		echo "Shelfspace rows have been created.<br>";
    		for ($i=1; $i <= 15; $i++) { 
    			DB::table('keys')->insert(array(
		            array('id'=>$i,'name'=>"Key$i",'description'=>'Lorem ipsum','created_at'=>now(),'updated_at'=>now())
				));
    		}
    		echo "Key rows have been created.<br>";
    		echo "<br><br>All rows have been created!";
    	}
    	else {
    		echo "Tables are not empty!";
    	}
		
    	return view('svs.create');
    	
    }*/

    public function storeShelf() {
    	$storeShelf = new Shelfspace();

    	$storeShelf->nummer = request('rpnr');

    	$storeShelf->save();

    	return redirect('firstsite');
    }
    public function storeKey() {
    	$storeKey = new ShelfKey();

    	$storeKey->name = request('keyname');
    	$storeKey->description = request('keyDescription');

    	$storeKey->save();

    	return redirect('firstsite');
    }

    public function storeKeyIntoShelf() {
    	$shelf = new Shelfspace();
    	$key = new ShelfKey();

    	$key->where('name',request('keyname'))->update(['shelfspace_id' => $shelf->where('nummer',request('rpnr'))->first()->id]);

    	$shelf->where('nummer',request('rpnr'))->update(['shelf_key_id' => $key->where('name',request('keyname'))->first()->id]);
    	return redirect('firstsite');
    }

    public function takeKeyOutOfShelf() {
		$shelf = new Shelfspace();
    	$key = new ShelfKey();

    	$idval = $key->where('name',request('keyname'))->first()->shelfspace_id;

    	$key->where('name',request('keyname'))->update(['shelfspace_id' => null]);
    	$shelf->where('id',$idval)->update(['shelf_key_id' => null]);
    	return redirect('firstsite');
    }

}
