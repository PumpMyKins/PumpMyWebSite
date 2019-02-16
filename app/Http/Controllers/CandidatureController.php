<?php

namespace App\Http\Controllers;

use App\Candidature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CandidatureStore;
use Illuminate\Support\Str;
use Auth;
use Gate;

class CandidatureController extends Controller
{

	public function indexActual() 
	{

		$candidature = Candidature::status()->paginate(10);
		return view('panel.candidature.index', compact('candidature'));
	}
	public function indexOld() 
	{

		$candidature = Candidature::statusAccepted()->paginate(10);
		return view('panel.candidature.index', compact('candidature'));
	}
	public function create()
	{
		return view('panel.candidature.create');
	}
	public function store(CandidatureStore $request)
	{
		$data = $request->only('type', 'prenom', 'age', 'horaire', 'motivation', 'anciennete', 'presentation', 'sanction');
		$data['slug'] = str_slug($data['prenom'], Str::random());
		$data['user_id'] = Auth::user()->id;
		$data['pseudo'] = Auth::user()->name;
		$candidature = Candidature::create($data);
		return redirect()->route('candidature_list');
	}
	public function show($id)
	{
		$candidature = Candidature::all()->find($id);
		return view('panel.candidature.show', compact('candidature'));
	}

	/*Gestion des états des posts ainsi des avis des modérateurs*/

	public function accept(Candidature $candidature)
	{
		$candidature->status = true;
		$candidature->state = "Accepté !";
		$candidature->save();
		return back();
	}
	public function refuse(Candidature $candidature)
	{
		$candidature->state = "Refusé !";
		$candidature->status = true;
		$candidature->save();
		return back();
	}
	public function upvote(Candidature $candidature)
	{
		$candidatureUpvoteArray = explode(",", $candidature->upvote);
		$candidatureDownvoteArray = explode(",", $candidature->downvote);
		if(in_array(Auth::user()->name , $candidatureDownvoteArray)){
			$nameposition = array_search(Auth::user()->name , $candidatureDownvoteArray);
			unset($candidatureDownvoteArray[$nameposition]);
			array_push($candidatureUpvoteArray, Auth::user()->name);
		}

		elseif (in_array(Auth::user()->name, $candidatureUpvoteArray)) {
			$nameposition = array_search(Auth::user()->name, $candidatureUpvoteArray);
			unset($candidatureUpvoteArray[$nameposition]);
		}

		else {
			array_push($candidatureUpvoteArray, Auth::user()->name);
		}

		$candidature->upvote = implode(",", $candidatureUpvoteArray);
		$candidature->downvote = implode(",", $candidatureDownvoteArray);
		$candidature->save();
		return back();
	}
	public function downvote(Candidature $candidature)
	{
		$candidatureUpvoteArray = explode(",", $candidature->upvote);
		$candidatureDownvoteArray = explode(",", $candidature->downvote);

		if(in_array(Auth::user()->name, $candidatureUpvoteArray)){
			$nameposition = array_search(Auth::user()->name, $candidatureUpvoteArray);
			unset($candidatureUpvoteArray[$nameposition]);
			array_push($candidatureDownvoteArray, Auth::user()->name);
		}

		elseif (in_array(Auth::user()->name, $candidatureDownvoteArray)) {
			$nameposition = array_search(Auth::user()->name, $candidatureDownvoteArray);
			unset($candidatureDownvoteArray[$nameposition]);
		}

		else {
			array_push($candidatureDownvoteArray, Auth::user()->name);
		}

		$candidature->upvote = implode(",", $candidatureUpvoteArray);
		$candidature->downvote = implode(",", $candidatureDownvoteArray);
		$candidature->save();
		return back();
	}
}
