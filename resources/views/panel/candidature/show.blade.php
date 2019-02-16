@extends('layouts.paneltemplate')

@section('title')

Panel

@endsection

@section('content')
<div class="col-6">
    <div class="card">
        <div class="card-header">Candidature de <strong>{{ $candidature->name }}</strong></div>
        <div class="card-body">
            <p><strong>Candidat(e) pour un poste de :</strong> {{ $candidature->type }}</p>
            <hr>
            <p><strong>Prénom : </strong><br> {{ $candidature->prenom }}</p>
            <hr>
            <p><strong>Âge : </strong><br>{{ $candidature->age }} ans</p>
            <hr>
            <p><strong>Horaires de disponibilitées :</strong> <br> {{ $candidature->horaire }}</p>
            <hr>
            <p><strong>Mes motivations :</strong> <br> {{ $candidature->motivation }}</p>
            <hr>
            <p><strong>Mon anciènnetée sur la communautée :</strong> <br> {{ $candidature->anciennete }}</p>
            <hr>
            <p><strong>Qui je suis :</strong> <br> {{ $candidature->presentation }}</p>
            <hr>
            <p><strong>Mes sanction dans le passé :</strong> <br> {{ $candidature->sanction }}</p>
        </div>
    </div>
</div>
@endsection

@section('navbarstaff')
@if($candidature->status == 0)
@can('staff')
<hr>
<div class="nav-item">
    <a class="nav-link" href="{{ route('upvote_candidature', ['candidature' => $candidature->id]) }}">Je suis pour</a>
</div>
<div class="nav-item">
    <a class="nav-link" href="{{ route('downvote_candidature', ['candidature' => $candidature->id]) }}">Je suis Contre</a>
</div>
@endcan
@if(Gate::check('can_promote') || Gate::check('universal_protection')) 
<hr>
<div class="nav-item">
    <a class="nav-link" href="{{ route('accept_candidature', ['candidature' => $candidature->id]) }}">J'accepte la candidature</a>
</div>
<div class="nav-item">
    <a class="nav-link" href="{{ route('refuse_candidature', ['candidature' => $candidature->id]) }}">Je refuse la candidature</a>
</div>
@endif
@else
<hr>
<h4>La candidature est déjà {{ $candidature->state }}</h4>
@endif
@if(count(explode(',', $candidature->downvote))> 0 or count(explode(',', $candidature->upvote))>0)
<hr>
<h4 class="mx-auto" style="width: 175px">Liste des votes :</h4>
<div class="row">
    <div class="col">
        <h4>Pour :</h4>
        @foreach(explode(',', $candidature->upvote) as $upvoter)
        <h5 class="upvoter">{{ $upvoter }}</h5>
        @endforeach
    </div>
    <div class="col">
        <h4>Contre :</h4>
        @foreach(explode(',', $candidature->downvote) as $downvoter)
        <h5 class="downvoter">{{ $downvoter }}</h5>
        @endforeach
    </div>
</div>
@endif
<hr>
<div class="nav-item mx-auto d-bloc" style="width: 175px">
    <a class="btn btn-danger" href="{{ route('candidature_list') }}">Revenir en arrière</a>
</div>
@endsection
