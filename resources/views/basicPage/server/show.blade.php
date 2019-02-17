@extends('layouts.servertemplate')

@section('title')
Nos Serveurs
@endsection

@section('content')
<div class="row">
	<div class="col">

	</div>
	<div class="col-6">
		<div class="card">
			<div class="card-header">Serveur <strong>{{ $server->name }}</strong></div>
			<div class="card-body">
				<div class="img-card">
					<img src='{{ asset("images/server/$server->image") }}' alt="server-image"/>
				</div>
				<div class="description">
					{!! $server->description !!}
				</div>
				@if(!$server->close AND $server->open_date < \Carbon\Carbon::now())
				<hr>
				<h5>Pour le rejoindre : </h5>
				<strong><h6>{{ $server->ip }}</h6></strong>
				@endif
			</div>
		</div>
	</div>
	<div class="col">
		@can('universal_protection')
		<div class="card">
			<div class="card-header">Espace Serveurs</div>

			<div class="card-body">
				<div class="card-info">
					Modification rapide :
				</div>
				@if(!$server->close AND $server->open_date < \Carbon\Carbon::now())
				<div class="nav-item">
    				<a class="nav-link" href="{{ route('close_server', ['server' => $server->id]) }}">Fermer le serveur</a>
				</div>
				@endif
				@if($server->close)
				<div class="nav-item">
    				<a class="nav-link" href="{{ route('reopen_server', ['server' => $server->id]) }}">Réouvrir le serveur</a>
				</div>
				@endif
				@if($server->open_date > \Carbon\Carbon::now())
				<div class="nav-item">
    				<a class="nav-link" href="{{ route('forceopen_server', ['server' => $server->id]) }}">Forcer l'ouverture à aujourd'hui</a>
				</div>
				@endif
				<div class="nav-item">
    				<a class="nav-link" href="{{ route('delete_server', ['server' => $server->id]) }}">Supprimer le serveur</a>
				</div>
				<hr>
				<div class="card-info">
					Modification complexe :
				</div>
				<div class="nav-item">
    				<a class="nav-link" href="{{ route('edit_server', ['server' => $server]) }}">Modifier les information</a>
				</div>
				<hr>
			</div>
		</div>
		@endcan
		<div class="card">
			<div class="card-header">Espace Serveur</div>
			<div class="card-body">
				<a class="btn btn-danger" href="{{ route('list_server') }}">Revenir en arrière</a>
			</div>
		</div>
	</div>
</div>
@endsection
