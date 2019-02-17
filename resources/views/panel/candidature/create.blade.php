@extends('layouts.paneltemplate')

@section('title')

Candidature - Panel

@endsection

@section('content')
<div class="col-6">
    <div class="card">
        <div class="card-header">Dépôt de Candidature</div>
        <div class="card-body">
            <form class="form-horizontal" role="form" method="post" action="{{ route('store_candidature') }}">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                    <label for="type">Type de Candidature ?</label>
                    <select id="type" type="" class="form-control" name="type" required autofocus>
                        <option>Staff</option>
                        <option>Développeur</option>
                        <option>Builder</option>
                        <option>Helper</option>
                    </select>
                            @if ($errors->has('type'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('type') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-row">
                    <div class="col">
                        <div class="form-group {{ $errors->has('prenom') ? ' has-error' : '' }}">
                            <label for="prenom">Prénom(s) ?</label>
                            <input type="text" id="prenom" class="form-control" name="prenom" value="{{ old('prenom') }}" required>
                            @if ($errors->has('prenom'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('prenom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group {{ $errors->has('age') ? ' has-error' : '' }}">
                            <label for="age">Âge ?</label>
                            <input type="text" id="age" class="form-control" name="age" value="{{ old('age') }}" required>
                            @if ($errors->has('age'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('horaire') ? ' has-error' : '' }}">
                    <label for="horaire">Vos horaires ?</label>
                    <textarea type="text" name="horaire" id="horaire" class="form-control" required row="5" value="{{ old('horaire') }}"></textarea>
                            @if ($errors->has('horaire'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('horaire') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-group {{ $errors->has('motivation') ? ' has-error' : '' }}">
                    <label for="motivation">Vos motivations ?</label>
                    <textarea type="text" name="motivation" id="motivation" class="form-control" required row="5" value="{{ old('motivation') }}"></textarea>
                    <comment>Il vous reste <span id="charsmotivation"> 600</span> caractères</comment>
                            @if ($errors->has('motivation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('motivation') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-group {{ $errors->has('anciennete') ? ' has-error' : '' }}">
                    <label for="anciennete">Votre ancienneté ?</label>
                    <textarea type="text" name="anciennete" id="anciennete" class="form-control" required row="5" value="{{ old('anciennete') }}"></textarea>
                    <comment>Il vous reste <span id="charsanciennete"> 600</span> caractères</comment>
                            @if ($errors->has('anciennete'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('anciennete') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-group {{ $errors->has('presentation') ? ' has-error' : '' }}">
                    <label for="presentation">Presentez vous un peu ?</label>
                    <textarea type="text" name="presentation" id="presentation" class="form-control" required row="5" value="{{ old('presentation') }}"></textarea>
                    <comment>Il vous reste <span id="charspresentation"> 1000</span> caractères</comment>
                            @if ($errors->has('presentation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('presentation') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-group {{ $errors->has('sanction') ? ' has-error' : '' }}">
                    <label for="sanction">Avez vous été sanctionné dans le passé ?</label>
                    <textarea type="text" name="sanction" id="sanction" class="form-control" required row="5" value="{{ old('sanction') }}"></textarea>
                    <comment>Il vous reste <span id="charssanction"> 600</span> caractères</comment>
                            @if ($errors->has('sanction'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sanction') }}</strong>
                                </span>
                            @endif
                </div>
                <div class="form-check {{ $errors->has('rules') ? ' has-error' : '' }}">
                    <input type="checkbox" class="form-check-input" id="rules" name="rules" required>
                    <label class="form-check-label" for="rules">J'accepte les règles de la communautés PumpMyKins et m'engage à respecter les règlements de celle-ci.</label>
                    @if ($errors->has('rules'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rules') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                        <button type="submit" class="btn btn-success">
                            Poster la candidature !
                        </button>
                        <a href="{{ route('panel') }}" class="btn btn-danger">
                            Annuler la candidature !
                        </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/candidatureCharsCounter.js') }}"></script>
@endsection