<?php

namespace App\Http\Controllers\Panel;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    	$this->middleware('auth');
        $this->middleware(['role:responsable', 'permission:manage user'])->only(['showAll', 'getAccount', 'updateAccount']);
    }

    /**
     * Show the application account dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $user = Auth::user();
        return view('panel.account', compact('user'));
    }

    /**
     * Show one account.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar' => ['nullable', 'file', 'dimensions:max_width:400,max_height:400', 'mimes:jpeg,png,gif,jpg,svg', 'max:2048'],
        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $url = $request->avatar->storeAs('avatars', $avatarName);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = 'avatars/'.$avatarName;
        $user->save();

        return back()->with('success', __('New Information Saved Successfully'));
    }

    /**
     * Show all the application accounts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showAll()
    {
    	$users = User::all();
        return view('panel.accounts', compact('users'));
    }

    /**
     * Show one account.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAccount($id)
    {
    	$user = User::findOrFail($id);
        return view('panel.account', compact('user'));
    }

    /**
     * Show one account.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateAccount(Request $request)
    {
    	$validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'avatar' => ['nullable', 'file', 'dimensions:max_width:400,max_height:400', 'mimes:jpeg,png,gif,jpg,svg', 'max:2048'],
        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $url = $request->avatar->storeAs('avatars', $avatarName);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = 'avatars/'.$avatarName;
        $user->save();

        return back()->with('success', __('New Information Saved Successfully'));
    }
}
