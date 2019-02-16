@extends('layouts.servertemplate')

@section('title')
Nos Serveurs
@endsection

@section('content')
	<div class="row">
		<div class="col">
			<div class="card">
					<div class="card-header">Espace Serveurs</div>

					<div class="card-body">
						<div class="card-info">
							Paramètres de recherche :
						</div>
						{{ Form::open(array('url' => '/servers')) }}

						<div class="form-group">
							<label class="switch-wrap">
							  <input type="checkbox" name="open" value="1" <?php if (isset($servers)): echo 'checked' ?>
							  	
							  <?php endif ?>/>
							  <div class="switch"></div>
							</label>
							{{ Form::label('open', 'Afficher les serveurs ouverts') }}
						</div>
						<div class="form-group">
							<label class="switch-wrap">
							  <input type="checkbox" name="development" value="1" <?php if (isset($future_server)): echo 'checked' ?>
							  	
							  <?php endif ?>/>
							  <div class="switch"></div>
							</label>
							{{ Form::label('development', 'Afficher les serveurs en développement') }}
						</div>
						<div class="form-group">
							<label class="switch-wrap">
							  <input type="checkbox" name="close" value="1" <?php if (isset($old_server)): echo 'checked' ?>
							  	
							  <?php endif ?>/>
							  <div class="switch"></div>
							</label>
							{{ Form::label('close', 'Afficher les serveurs fermés') }}
						</div>
						<button type="submit" class="btn btn-primary">
                    		Affiner la recherche
                		</button>

						{{ Form::close() }}
					</div>
				</div>
		</div>
		<div class="col-6">
			<div class="row">
			@if(isset($servers))
				@foreach($servers as $server)
				<div class="col-xs-12 col-sm-4">
					<div class="card">
						<div class="img-card">
							<span class="badge badge--success badge--small">Ouvert !</span>
							<img src='{{ asset("images/server/$server->image") }}' alt="server-image"/>
						</div>
						<div class="card-content">
							<h4 class="card-title">
								<a href="#"> Serveur {{ $server->name }}</a>
							</h4>
							<p class="description">
								{{ $server->short_description }}
							</p>
						</div>
						<div class="card-read-more">
							<a href="{{ route('show_server', ['id' => $server->id]) }}"
								class="btn btn-link btn-block">
								Nous rejoindre !
							</a>
						</div>
					</div>
				</div>
			@endforeach
			@endif
			@if(isset($future_server))
				@foreach($future_server as $server)
				<div class="col-xs-12 col-sm-4">
					<div class="card">
						<div class="img-card">
							<span class="badge badge--warning badge--small">En développement !</span>
							<img src='{{ asset("images/server/$server->image") }}' alt="server-image"/>
						</div>
						<div class="card-content">
							<h4 class="card-title">
								<a href="#"> Serveur {{ $server->name }}</a>
							</h4>
							<p class="description">
								{{ $server->short_description }}
							</p>
						</div>
						<div class="card-read-more">
							<a href="{{ route('show_server', ['id' => $server->id]) }}"
								class="btn btn-link btn-block">
								Les premières informations
							</a>
						</div>
					</div>
				</div>
				@endforeach
		@endif
			@if(isset($old_server))
				@foreach($old_server as $server)
				<div class="col-xs-12 col-sm-4">
					<div class="card">
						<div class="img-card">
							<span class="badge badge--danger badge--small">Fermé !</span>
							<img src='{{ asset("images/server/$server->image") }}' alt="server-image"/>
						</div>
						<div class="card-content">
							<h4 class="card-title">
								<a href="#"> Serveur {{ $server->name }}</a>
							</h4>
							<p class="description">
								{{ $server->short_description }}
							</p>
						</div>
						<div class="card-read-more">
							<a href="{{ route('show_server', ['id' => $server->id]) }}"
								class="btn btn-link btn-block">
								Information
							</a>
						</div>
					</div>
				</div>
				@endforeach
		@endif
		</div>
		
		</div>
		<div class="col">
					@can('universal_protection')
			<div class="card">
					<div class="card-header">Espace Fondateur :</div>

					<div class="card-body">
						<div class="card-info">
							Gestion des serveurs :
						</div>
						<div class="nav-item disable">
							<a class="nav-link active" href="{{ url('/servers/create') }}">Ajouter un serveur</a>
						</div>
					</div>
				</div>
					@endcan
		</div>
	</div>
	@endsection