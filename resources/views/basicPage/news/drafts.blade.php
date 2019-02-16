@extends('layouts.newstemplate')

@section('title')

    Brouillon

@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Drafts <a class="btn btn-sm btn-default pull-right" href="{{ route('list_news') }}">Return</a>
                </div>

                <div class="panel-body">
                    <div class="row">
                    @foreach($news as $new)
                        <div class="col-sm-6 col-md-4">
                            <div class="thumbnail">
                            <div class="caption">
                                <h3><a href="{{ route('show_news', ['id' => $new->id]) }}">{{ $new->title }}</a></h3>
                                <p>{{ str_limit($new->body, 50) }}</p>
                                <p>
                                @can('can_manage_news')
                                    <a href="{{ route('publish_news', ['id' => $new->id]) }}" class="btn btn-sm btn-default" role="button">Publier</a> 
                                @endcan
                                    <a href="{{ route('edit_news', ['id' => $new->id]) }}" class="btn btn-default" role="button">Modifier</a> 
                                </p>
                            </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection