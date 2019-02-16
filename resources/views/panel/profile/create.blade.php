@extends('layouts.paneltemplate')

@section('title')

Profile - Panel

@endsection

@section('content')

<div class="col-6">
    <div class="card">
        <div class="card-header">Créer son profile</div>
        <div class="card-body">
            {!! Form::model($profile, ['action' => 'ProfileController@store', 'files' => true]) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('prenom', 'Prénom(s) :') !!}
                            {!! Form::text('prenom', '', ['class' => 'form-control'])  !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nom', 'Nom :') !!}
                            {!! Form::text('nom', '', ['class' => 'form-control'])  !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('adresse', 'Adresse :') !!}
                            {!! Form::text('adresse', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('zipcode', 'Code Postale :') !!}
                            {!! Form::text('zipcode', '', ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('country', 'Pays :') !!}
                            {!! Form::select('country', array(
                                'France' => 'France',
                                'Belgique' => 'Belgique',
                                'Suisse' => 'Suisse',
                                'Portugal' => 'Portugal',
                                'Zimbabwe' => 'Zimbabwe',
                                'Canada' => 'Canada',
                                'Quebec' => 'Québec',
                                ), '',['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                        <div class="form-group">
                            {!! Form::label('ville', 'Ville / Village :') !!}
                            {!! Form::text('ville', '', ['class' => 'form-control']) !!}
                        </div>
                <div class="form-group">
                    {!! Form::label('image', 'Image de Profile') !!}
                    {!! Form::file('image', array('class' => 'form-control-file')) !!} 
                </div>
                <div class="form-group">
                    {!! Form::label('bio', 'Biographie') !!}
                    {!! Form::textarea('bio', null,['class' => 'form-control']) !!} 
                </div>
                <div class="form-group">
                    {!! Form::label('privacy', "Profile Privé :") !!}
                    {!! Form::checkbox('privacy', '1', true, ['class' => 'form-control'])!!}
                </div>
                <div class="form-group">
                    {!! Form::label('stat_privacy', "Statistique Privé :") !!}
                    {!! Form::checkbox('stat_privacy', '1', false, ['class' => 'form-control'])!!}
                </div>
                <button type="submit" class="btn btn-primary">
                    Créer mon profile
                </button>
                {{ Form::close() }}
        </div>
    </div>
</div>

@endsection

@section('publicinformation')
    
    <div class="card">
        <div class="card-header">Explications :</div>
        <div class="card-body">
            <p>
            Ici vous pouvez renseignez des information complémentaire sur vous. Aucune information n'est obligatoire. De plus vous pouvez si vous le souhaitez définir vos information comme publique ou non. Si celle-ci sont publique tout le monde pourra les voirs. Autrement seulement les membres faisant partie du Conseil d'Administration de l'association PumpMyKins. De plus nous récupérons des statistique, heure de jeux, niveau... (Rien de personnel) vous pouvez choisir de rendre priver ces informations.
            <br> Vos informations privées sont de base priver. 
            <br> Vos statistiques sont de base publique.
            </p>
        </div>
    </div>

@endsection

@section('script')

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