@extends('layouts.basictemplate')

@section('title')
Nos Serveurs
@endsection

@section('content')
	<div class="col-6">
		<div class="card">
			<div class="card-header">Ajouter un serveur</div>
			<div class="card-body">

				{!! Form::model($server, ['action' => 'ServerController@store', 'files' => true]) !!}
				<div class="row">
					<div class="col">
						<div class="form-group">
							{!! Form::label('name', 'Nom du Modpack ou du Serveur') !!}
							{!! Form::text('name', '', ['class' => 'form-control'])  !!}
						</div>
					</div>
					<div class="col">
						<div class="form-group">
							{!! Form::label('ip', 'IP du serveur') !!}
							{!! Form::text('ip', '', ['class' => 'form-control'])  !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group">
							{!! Form::label('short_description', 'Petite description') !!}
							{!! Form::text('short_description', '', ['class' => 'form-control']) !!}
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
					{!! Form::date('open_date', '', ['class' => 'form-control'])!!}
				</div>
				<button type="submit" class="btn btn-primary">
                    Ajouter le serveur
                </button>
				{{ Form::close() }}
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