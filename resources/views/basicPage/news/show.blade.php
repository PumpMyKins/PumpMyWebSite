@extends('layouts.newstemplate')

@section('title')

Show

@endsection

@section('content')
<div class="row">
    <div class="col">
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header"><strong> {{ $news->title }} </strong>
                @switch($news->tag_id)
                @case(1)
                <span class="badge badge--info">News !</span>
                @break
                @case(2)
                <span class="badge badge--success badge--small">Idée !</span>
                @break
                @case(3)
                <span class="badge badge--danger badge--small">Important !</span>
                @break
                @case(4)
                <span class="badge badge--danger badge--small">ItemBan !</span>
                @break
                @case(10)
                <span class="badge badge--success badge--small">ChangeLog !</span>
                @break
                @case(10)
                <span class="badge badge--default badge--small">DevNews !</span>
                @break
                @endswitch 
            </div>
            <div class="card-body">
                <div class="nav-news">
                    {!! $news->content !!}
                    @can('can_manage_news')
                    <a href="{{ route('delete_news', ['id' => $new->id]) }}" class="btn btn-danger btn-sm" role="button">Supprimer</a>
                    @endcan
                    <a class="btn btn-info" href="{{ route('list_news') }}">Retour en arrière !</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col">

    </div>
</div>
@endsection