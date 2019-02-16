@extends('layouts.basictemplate')

@section('title')
Nos Serveurs
@endsection

@section('content')
<div class="row">
	<div class="col">
	</div>
	<div class="col-6">
		<div class="card">
			<div class="card-header">Modifier un serveur</div>
			<div class="card-body">

				{!! Form::model($server, ['method' => 'post', 'route' => array('update_server', $server->id), 'files' => true]) !!}
				<div class="row">
					<div class="col">
						<div class="form-group">
							{!! Form::label('name', 'Nom du Modpack ou du Serveur') !!}
							{!! Form::text('name', "$server->name", ['class' => 'form-control'])  !!}
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							{!! Form::label('ip', 'IP du serveur') !!}
							{!! Form::text('ip', "$server->ip", ['class' => 'form-control'])  !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							{!! Form::label('short_description', 'Petite description') !!}
							{!! Form::text('short_description', "$server->short_description", ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							{!! Form::label('image', 'Image de Carte du Serveur') !!}
							{!! Form::file('image', array('class' => 'form-control-file')) !!}
						</div>
					</div>
				</div>
				<div class="form-group">
					{!! Form::label('description', 'Description') !!}
					{!! Form::textarea('description', null,['class' => 'form-control']) !!} 
				</div>
				<div class="form-group">
					{!! Form::label('open_date', "Date d'ouverture prévu") !!}
					{!! Form::date('open_date', "$server->open_date", ['class' => 'form-control'])!!}
				</div>
				<button type="submit" class="btn btn-primary">
					Modifier le serveur
				</button>
				{{ Form::close() }}
			</div>
		</div>
	</div>
	<div class="col">
		<div class="card">
			<div class="card-header">Espace Serveur</div>
			<div class="card-body">
				<a class="btn btn-danger" href="{{ route('list_server') }}">Revenir en arrière</a>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/vendor/tinymce/tinymce.min.js') }}"></script>
<script>
	var editor_config = {

		path_absolute : "{{ URL::to('/') }}/",
		selector: "textarea",
		theme: 'modern',
		plugins: [
		'advlist autolink lists link image charmap print preview anchor textcolor',
		'searchreplace visualblocks code fullscreen',
		'insertdatetime media table contextmenu paste code help wordcount'
		],
		toolbar: "insert | bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, styleselect, fontselect, fontsizeselect, bullist, numlist, blockquote, removeformat",
		relative_urls: false,

	}
	tinymce.init(editor_config);

</script>
@endsection