@extends('layouts.paneltemplate')

@section('title')

Panel

@endsection

@section('content')
<div class="col-6">
    <div class="card">
        <div class="card-header"><img src='{{ asset("images/profile/$profile->image") }}' alt="profile_image" class="profile-image"> Profile de <strong>{{ $user->name }}</strong><span class="badge badge--info">@if($role !== null) {{ $role->name }} @else 404 @endif </span></div>
        <div class="card-body">
            @if(Auth::user()->id == $profile->user_id || $profile->privacy == 0)
            <p><strong>Identité : </strong> {{ $profile->prenom }} {{ $profile->nom }}</p>
            <p><strong>Localisation :</strong> {{ $profile->adresse }}</p>
            <p><strong>Ville :</strong> {{ $profile->ville }}</p>
            <p><strong>Code Postale :</strong> {{ $profile->zipcode }}</p>
            <p><strong>Pays :</strong> {{ $profile->country }}</p>
            <p><strong>Biographie :</strong> {!! $profile->bio !!}</p>

            @endif
        </div>
    </div>
</div>
@endsection

@section('publicinformation')

<div class="card">
    <div class="card-header">Gestion du profil :</div>
    <div class="card-body">
        @can('modify-profile',$profile)
        <p><a class="btn btn-info" href="{{ route('update_profile', ['id' => $profile->id]) }}">Modifier le profile</a></p>
        @endcan
        @can('delete-profile',$profile)
        <p><a class="btn btn-danger" href="{{ route('delete_profile', ['id' => $profile->id]) }}">Supprimer mon compte</a></p>
        <p>La suppression du compte est définitive. Toutes les informations vous concernant seront supprimer de nos base de données. Seul les informations obtenues à des fins statistiques seront conservés de manière annonyme.</p>
        @endcan

    </div>
</div>

@endsection
