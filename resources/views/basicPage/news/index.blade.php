@extends('layouts.newstemplate')

@section('title')

Nouveautées

@endsection

@section('content')
<div class="row">
    <div class="col">
        @if(Gate::check('can_manage_news') || Gate::check('can_propose_news')) 
        <div class="card">
            <div class="card-header">Navigation News</div>
            <div class="card-body">
                <div class="nav-news">
                    @can('can_manage_news')
                    <a class="btn btn-info" href="{{ route('list_draft') }}">Listes des brouillons</a>
                    @endcan
                    @can('propose_news')
                    <a class="btn btn-info" href="{{ route('create_news') }}">Proposez un article !</a>
                    @endcan
                </div>
            </div>
        </div>
        @endif
    </div>
    <div class="col-6">
        <div class="panel-body">
                @foreach($news as $new)
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title"><a href="{{ route('show_news', ['id' => $new->id]) }}">{{ $new->title }}</a></h4>
                            @switch($new->tag_id)
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
                            <p class="description">{!! strip_tags(str_limit($new->content, 120)) !!}</p>
                            @can('can_manage_news', $new)
                            <p>
                                <a href="{{ route('update_news', ['id' => $new->id]) }}" class="btn btn-warning btn-sm" role="button">Edit</a>
                                <a href="{{ route('delete_news', ['id' => $new->id]) }}" class="btn btn-danger btn-sm" role="button">Supprimer</a>
                            </p>
                            @endcan
                </div>
                </div>
                @endforeach
                </div>
        </div>
    <div class="col">
        <div class="card">
            <div class="card-header">Explications :</div>
            <div class="card-body">
                Ici, vous pouvez proposer différents types d'articles qui seront publiques ! Bien sur vos articles ne seront publiés seulement après validation d'un membre du staff. Orthographe soignée exigée et le sérieux est de mise. Les thèmes ? Tout ce que vous souhaitez. De plus nous publierons les nouveautées de la communautée ici.
            </div>
            </div>
        </div>
    </div>
</div>
@endsection