<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserChanger;
use Auth;
use Gate;
use App\User;
use App\Role;


class PanelController extends Controller
{
    public function changeRole(UserChanger $request)
    {
        $user = User::where('id', $request->id)->first();

        $user->roles()->detach();
		$user->roles()->attach(Role::where('slug', $request->slug)->first());
        
        return back();
    }

    public function listStaff() {

    	$users = User::whereHas('roles', function($q) {
    			$q->where('slug', 'fonda');
    			$q->orWhere('slug', 'modo');
				$q->orWhere('slug', 'admin');
    			$q->orWhere('slug', 'resp');
    		})->paginate();

    	return view('panel.list', compact('users'));
    }

    public function listplayer() {

    	$users = User::paginate(10);

    	return view('panel.list', compact('users'));
    }
}
