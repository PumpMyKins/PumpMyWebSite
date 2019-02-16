@extends('layouts.paneltemplate')

@section('title')

Profile - Panel

@endsection

@section('content')

<div class="col-6">
    <div class="card">
        <div class="card-header">Modifier son profile</div>
        <div class="card-body">
            {!! Form::model($profile, ['method' => 'post', 'route' => array('update_profile', $profile->id), 'files' => true]) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('prenom', 'Prénom(s) :') !!}
                            {!! Form::text('prenom', "$profile->prenom", ['class' => 'form-control'])  !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('nom', 'Nom :') !!}
                            {!! Form::text('nom', "$profile->nom" , ['class' => 'form-control'])  !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            {!! Form::label('adresse', 'Adresse :') !!}
                            {!! Form::text('adresse', "$profile->adresse", ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('zipcode', 'Code Postale :') !!}
                            {!! Form::text('zipcode', "$profile->zipcode", ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('country', 'Pays :') !!}
                            {!! Form::select('country', array(
                                'Selectionner un pays' => 'Selectionner un Pays',
                                'France' => 'France',
                                'Belgique' => 'Belgique',
                                'Suisse' => 'Suisse',
                                'Portugal' => 'Portugal',
                                'Zimbabwe' => 'Zimbabwe',
                                'Canada' => 'Canada',
                                'Quebec' => 'Québec',
                                ), $profile->country ,['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                                        <div class="form-group">
                            {!! Form::label('ville', 'Ville / Village :') !!}
                            {!! Form::text('ville', "$profile->ville", ['class' => 'form-control']) !!}
                        </div>
                <div class="form-group">
                    {!! Form::label('image', 'Image de Profile') !!}
                    {!! Form::file('image', array('class' => 'form-control-file')) !!} 
                </div>
                <div class="form-group">
                    {!! Form::label('bio', 'Biographie') !!}
                    {!! Form::textarea('bio', $profile->bio,['class' => 'form-control']) !!} 
                </div>
                <div class="row">
                    <div class="col">
                <div class="form-group">
                    {!! Form::label('privacy', "Profile Privé :") !!}
                    {!! Form::checkbox('privacy', '1', $profile->privacy, ['class' => 'form-control'])!!}
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!! Form::label('stat_privacy', "Statistique Privé :") !!}
                    {!! Form::checkbox('stat_privacy', '1', $profile->stat_privacy, ['class' => 'form-control'])!!}
                </div>
            </div></div>
                <button type="submit" class="btn btn-primary">
                    Valider les modification
                </button>
                <a href="{{ route('show_profile', ['id' => Auth::user()->id ])}}" class="btn btn-warning">Retour</a>
                {{ Form::close() }}
        </div>
    </div>
</div>

@endsection

@section('publicinformation')
    
    <div class="card">
        <div class="card-header">Explications :</div>
        <div class="card-body">
            Ici vous pouvez renseignez des information complémentaire sur vous. Aucune information n'est obligatoire. De plus vous pouvez si vous le souhaitez définir vos information comme publique ou non. Si celle-ci sont publique tout le monde pourra les voirs. Autrement seulement les membres faisant partie du Conseil d'Administration de l'association PumpMyKins. De plus nous récupérons des statistique, heure de jeux, niveau... (Rien de personnel) vous pouvez choisir de rendre priver ces informations.
            <br> Vos informations privées sont de base priver. 
            <br> Vos statistiques sont de base publique.
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