@extends('layouts.newstemplate')

@section('title')

Editer

@endsection

@section('content')
<div class="row">
    <div class="col">

    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">Modifier un Post</div>

            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST" action="{{ route('update_news', ['news' => $news->id]) }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="title" class="col-md-4 control-label">Titre</label>
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $news->title) }}" required autofocus>

                        @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                        <label for="content">Contenue :</label>
                        <textarea name="content" id="content" cols="30" rows="20" class="form-control">{{ old('content', $news->content) }}</textarea>
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
                            <option value="4">ItemBan !</option>
                            @can('universal_protection')
                            <option value="10">ChangeLog !</option>
                            <option value="11">DevNews !</option>@endcan
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-success">
                                Modifier
                            </button>
                            @can('can_manage_news')
                            <a href="{{ route('publish_news', ['news' => $news->id]) }}" class="btn btn-warning">
                                Publier
                            </a>
                            @endcan
                            <a href="{{ route('list_news') }}" class="btn btn-danger">
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