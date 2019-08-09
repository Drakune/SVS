<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Shelfspace;
use App\ShelfKey;
use App\User;
use DB;

class MyController extends Controller {

    #Ruft die Hauptseite auf
    public function index() {
        #Fragt ab, ob der Benutzer angemeldet ist
        if(Auth::check()) {
            #Speichert alle Daten aus der Tabelle in die Variable $shelf und $key
            $shelf = Shelfspace::all();
            $key = ShelfKey::all();
            #Gibt die View, also die Website, mit den 2 zuvor angelegten Variablen zurück 
            return view('svs.index',compact('shelf','key'));
        }
        #Wenn der Benutzer nicht angemeldet ist, wird er weitergeleitet auf die registrierseite
        else {
            return redirect('register');
        }

    	
    }

    public function dashboard() {
        $user = new User();
        if(Auth::check() && $user->where('name',Auth::user()->name)->value('role') == 'admin') {
            return view('svs.adminDashboard');
        }
        if(Auth::check()) {
            return view('svs.dashBoard');
        }
        else {
            return redirect('register')->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
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
        $user = new User();
        if(!(Auth::check()) || (!($user->where('name',Auth::user()->name)->value('role') == 'admin'))) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
    	$storeShelf = new Shelfspace();

        if($storeShelf->where('nummer',request('rpnr'))->value('nummer') == request('rpnr')) {
            return Redirect()->back()->with(['errorCreateShelf'=>'Dieser Regalplatzeintrag existiert schon!']);
        }

    	$storeShelf->nummer = request('rpnr');

    	$storeShelf->save();

    	return Redirect()->back()->with(['successCreateShelf'=>'Regalplatz wurde erfolgreich eingetragen']);
    }
    public function storeKey() {
        $user = new User();
        if(!(Auth::check()) || (!($user->where('name',Auth::user()->name)->value('role') == 'admin'))) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        $storeKey = new ShelfKey();
        if($storeKey->where('name',request('keyname'))->value('name') == request('keyname')) {
            return Redirect()->back()->with(['errorCreateKey'=>'Dieser Schlüsseleintrag existiert schon!']);
        }
        $storeKey->name = request('keyname');
        $storeKey->description = request('keyDescription');

        $storeKey->save();

        return Redirect()->back()->with(['successCreateKey'=>'Schlüssel wurde erfolgreich eingetragen']);
    }

    public function storeKeyIntoShelf() {
        if(Auth::check()) {
            $user = new User();
            $shelf = new Shelfspace();
            $key = new ShelfKey();

            if($shelf->where('nummer',request('rpnr'))->value('shelf_key_id') == !null) {
                return Redirect()->back()->with(['errorKeyOutShelfNoKey'=>'Der eingegebene Schlüssel wurde schon aus dem Regalplatz genommen!']);
            }

            if(!($shelf->where('nummer',request('rpnr'))->exists()) && !($key->where('name',request('keyname'))->exists())) {
                return Redirect()->back()->with(['errorStoreKeyInShelfBothNotExist'=>'Der eingegebene Regalplatz und Schlüssel existieren nicht!']);
            }

            if(!($shelf->where('nummer',request('rpnr'))->exists())) {
                return Redirect()->back()->with(['errorStoreKeyInShelfRPNotExist'=>'Der eingegebene Regalplatz existiert nicht!']);
            }

            if(!($key->where('name',request('keyname'))->exists())) {
                return Redirect()->back()->with(['errorStoreKeyInShelfKeyNotExist'=>'Der eingegebene Schlüssel existiert nicht!']);
            }

            $key->where('name',request('keyname'))->update(['shelfspace_id' => $shelf->where('nummer',request('rpnr'))->first()->id]);

            $shelf->where('nummer',request('rpnr'))->update(['shelf_key_id' => $key->where('name',request('keyname'))->first()->id]);
            return Redirect()->back()->with(['successStoreKeyInShelf'=>'Der Schlüssel wurde erfolgreich in das Regal gelagert!']);
            //return Redirect()->back()->with(['errorStoreKeyInShelfKeyAlreadyInShelf'=>'Der Schlüssel wurde erfolgreich in das Regal gelagert!']);
        }
        else {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }   	
    }

    public function takeKeyOutOfShelf() {
        if(Auth::check()) {
            $user = new User();
            $shelf = new Shelfspace();
            $key = new ShelfKey();

            if(!($key->where('name',request('keyname'))->exists())) {
                return Redirect()->back()->with(['errorKeyOutShelfNoKey'=>'Der eingegebene Schlüssel existiert nicht!']);
            }

            if($key->where('name',request('keyname'))->value('shelfspace_id') == null) {
                return Redirect()->back()->with(['errorKeyOutShelfNoKey'=>'Der eingegebene Schlüssel wurde schon aus dem Regalplatz genommen!']);
            }

            $idval = $key->where('name',request('keyname'))->first()->shelfspace_id;

            $key->where('name',request('keyname'))->update(['shelfspace_id' => null,'updated_by'=>Auth::user()->name]);
            $shelf->where('id',$idval)->update(['shelf_key_id' => null]);
            return Redirect()->back()->with(['successTakeKeyOutShelf'=>'Der Schlüssel wurde erfolgreich aus dem Regalplatz genommen!']);
        }
        else {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
    }

    public function deleteKey() {
        $user = new User();
        if(!(Auth::check()) || (!($user->where('name',Auth::user()->name)->value('role') == 'admin'))) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        $shelf = new Shelfspace();
        $key = new ShelfKey();

        if(!($key->where('name',request('keyname'))->value('name') == request('keyname'))) {
            return Redirect()->back()->with(['errorDeleteKey'=>'Schlüssel konnte nicht gelöscht wurden, da er nicht existiert.']);
        }
        else if($key->where('name',request('keyname'))->value('shelfspace_id') == null) {
            $key->where('name',request('keyname'))->delete();
            return Redirect()->back()->with(['successDeleteKey'=>'Schlüssel wurde erfolgreich gelöscht.']);
        }
        else if($key->where('name',request('keyname'))->value('shelfspace_id') == !(null)) {
            return Redirect()->back()->with(['errorDeleteKeyInShelf'=>'Schlüssel konnte nicht gelöscht werden, da er in einem Regalplatz liegt.']);
        }
    }

    public function deleteShelf() {
        $user = new User();
        if(!(Auth::check()) || (!($user->where('name',Auth::user()->name)->value('role') == 'admin'))) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        $shelf = new Shelfspace();
        $key = new ShelfKey();

        if(!($shelf->where('nummer',request('rpnr'))->value('nummer') == request('rpnr'))) {
            return Redirect()->back()->with(['errorDeleteShelf'=>'Regalplatz konnte nicht gelöscht wurden, da er nicht existiert.']);
        }
        else if($shelf->where('nummer',request('rpnr'))->value('shelf_key_id') == null) {
            $shelf->where('nummer',request('rpnr'))->delete();
            return Redirect()->back()->with(['successDeleteShelf'=>'Regalplatz wurde erfolgreich gelöscht.']);
        }
        else if($shelf->where('nummer',request('rpnr'))->value('shelf_key_id') == !(null)) {
            return Redirect()->back()->with(['errorDeleteShelfWithKey'=>'Regalplatz konnte nicht gelöscht werden, da er einen Schlüssel beinhaltet.']);
        }
    }

    public function managerp() {
        $user = new User();
        $shelf = Shelfspace::all();
        $key = ShelfKey::all();
        if(!(Auth::check())) {
            return redirect('register')->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        return view('svs.rpVerwaltung',compact('shelf','key'));
    }

    public function managekey() {
        $shelf = Shelfspace::all();
        $key = ShelfKey::all();
            
        if(!(Auth::check())) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        else return view('svs.keyVerwaltung',compact('shelf','key'));
    }

    public function manageuser() {
        $user = User::all();
        $userCheck = new User();
        if(!(Auth::check())) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        else return view('svs.userVerwaltung',compact('user','userCheck'));
    }

    public function renameKey() {
        $user = new User();
        if(!(Auth::check()) || (!($user->where('name',Auth::user()->name)->value('role') == 'admin'))) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        else {
            $oldName = request('keyname');
            $key = new ShelfKey();
            if($key->where('name',request('newKeyname'))->exists()) {
                return Redirect()->back()->with(['errorRenameKey'=>'Schlüssel konnte nicht umbenannt werden, da der Name schon existiert']);
            }
            $key->where('name',request('keyname'))->update(['name'=>request('newKeyname'),'description'=>request('newDesc')]);
            return Redirect()->back()->with(['successRenameKey'=>'Schlüssel >'.$oldName.'< wurde erfolgreich zu >'.request('newKeyname').' umbenannt.']);
        }
    }

    public function renameShelf() {
        $user = new User();
        if(!(Auth::check()) || (!($user->where('name',Auth::user()->name)->value('role') == 'admin'))) {
            return Redirect()->back()->with(['errorNotLoggedIn'=>'Diese Funktion ist nur für Admins verfügbar!']);
        }
        else {
            $oldNumber = request('rpnr');
            $shelf = new Shelfspace();
            if($shelf->where('nummer',request('newrpnr'))->exists()) {
                return Redirect()->back()->with(['errorRenameShelf'=>'Schlüssel konnte nicht umbenannt werden, da der Name schon existiert']);
            }
            $shelf->where('nummer',request('rpnr'))->update(['nummer'=>request('newrpnr')]);
            return Redirect()->back()->with(['successRenameShelf'=>'Regalplatz >'.$oldNumber.'< wurde erfolgreich zu >'.request('newrpnr').'< umbenannt.']);
        }
    }

    public function keyhistory() {
        $key = new ShelfKey();
        $user = new User();
        return view('svs.keyhistory',compact('key','user'));
    }

    public function managekeyperms() {
        $key = new ShelfKey();
        $user = new User();
        return view('svs.managekeyperms',compact('key','user'));
    }

}
