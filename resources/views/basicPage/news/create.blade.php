@extends('layouts.newstemplate')

@section('title')
	Ajouter - News
@endsection

@section('content')
    <div class="row">
        <div class="col">

        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">Ajouter une news !</div>
                <div class="card-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_news') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                
                                <label for="title">Titre :</label>
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                <label for="content">Description :</label>
                                <textarea  name="content" id="content" cols="30" rows="10" class="form-control"></textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif
                        </div>
                        <div class="form-group {{ $errors->has('tag_id') ? 'has-error' : '' }}">
                            <label for="tag_id">Choissiez le tag souhaité :</label>
                            <select class="custom-select" id="tag_id" name="tag_id">
                                <option value="1">News !</option>
                                <option value="2">Idée !</option>
                                <option value="3">Important !</option>
                                @can('universal_protection')
                                <option value="4">ItemBan !</option>
                                <option value="10">ChangeLog !</option>
                                <option value="11">DevNews !</option>@endcan
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Proposer le Post
                                </button>
                                <a href="{{ route('list_news') }}" class="btn btn-primary">
                                    Annuler
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">

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