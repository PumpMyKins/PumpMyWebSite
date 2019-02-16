<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProfile;
use App\Http\Requests\UpdateProfile;
use App\Profile;
use Auth;
use Gate;
use App\User;

class ProfileController extends Controller
{
    public function show($id){

    	$profile = Profile::where('user_id',$id)->first();
    	if($profile == null){
    		return redirect()->route('create_profile');
    	}
    	$user = User::find($id);
    	$role = $user->roles()->first();
    	return view('panel.profile.show', compact('profile', 'user', 'role'));
    }

    public function delete(Profile $profile)
    {
    	$prof = Profile::find($profile->id);
    	if($prof == null){
    		return abort(403);
    	}
    	$prof->delete();
    	return view('welcome');
    }

    public function create()
    {	
        $profile = new Profile;
    	return view('panel.profile.create', ['profile' => $profile]);
    }

    public function store(StoreProfile $request)
    {
    	$data = $request->only('prenom', 'nom', 'adresse', 'ville','zipcode', 'country', 'bio', 'stat_privacy', 'privacy');
    	$data['user_id'] = Auth::user()->id;
    	if($request->hasFile('image')) {

            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile');
            $image->move($destinationPath, $name);
            $data['image'] = $name;

        }
        else {
            $data['image'] = 'default.png';
        }
        $user = User::find($data['user_id']);
    	$user->profile()->create($data);
    	return redirect()->route('edit_profile', ['id' => $user->profile->id]);

    }

    public function edit(Profile $profile)
    {
    	return view('panel.profile.edit', compact('profile'));
    }

    public function update(Profile $profile, UpdateProfile $request)
    {
    	$data = $request->only('prenom', 'nom', 'ville','adresse', 'zipcode', 'country', 'bio', 'stat_privacy', 'privacy');
    	if($request->hasFile('image')) {

            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/profile');
            $image->move($destinationPath, $name);
            $data['image'] = $name;
        }
    	$profile->fill($data)->save();
    	return back();
    }
}
