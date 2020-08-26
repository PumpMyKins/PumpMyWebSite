<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
            'avatar' => ['nullable', 'file', 'dimensions:max_width:400,max_height:400', 'mimes:jpeg,png,gif,jpg,svg', 'max:2048'],
        ]);
        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $url = $request->avatar->storeAs('avatars', $avatarName);
        $user->avatar = 'avatars/'.$avatarName;
        $user->save();

        return back()->with('success', __('Avatar saved successfully'));
    }

    /**
     * Show all the application accounts.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showAll()
    {
        return view('panel.accounts', ['users' => User::all()]);
    }

    /**
     * Show one account.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getAccount($id)
    {
        return view('panel.account', ['user' => User::findOrFail($id)]);
    }

    /**
     * Show one account.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updateAccount(Request $request)
    {
        return view('panel.account', ['user' => User::findOrFail($id)]);
    }
}
