@extends('layouts.paneltemplate')

@section('title')

Liste staff

@endsection

@section('content')
<div class="col-6">
    <div class="card">
        <div class="card-header">Liste des @if(Route::current()->getName() == 'list_staff') staffs @else joueurs @endif</div>
        <div class="card-body">
            <table class="table table-bordered table-hover sortable">
                <thead>
                    <tr>
                        <th scope="col">Pseudo</th>
                        <th scope="col">Grade</th>
                        @can('can_promote')
                        <th scope="col">Modifier le grade</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        
                    <tr>
                        <th>@if($user->profile !== null) <a class="no-style" href="{{ route('show_profile',['id' => $user->id]) }}">@endif {{ $user->name }} @if($user->profile !== null)</a>@endif</th> 
                        <td>@if(count($user->roles) > 0) {{ $user->roles[0]->name }} @else <strong>Erreur sur le joueur</strong> @endif</td>
                        @can('can_promote')
                        <td>
                            @if(isset($user->roles[0])) 
                                @if($user->roles[0]->slug != 'fonda' || Auth::user()->roles[0]->slug == 'fonda')
                            <form class="form-horizontal" role="form" method="post" action="{{ route('change_role') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-7">
                                        <select id="slug" class="form-control" name="slug" required autofocus>
                                            <option value='joueur'>Joueur</option>
                                            <option value='modo'>Modérateur</option>
                                            <option value='admin'>Administrateur</option>
                                            <option value='resp'>Responsable</option>
                                            @can('universal_protection')<option value='fonda'>Fondateur</option>@endcan
                                        </select>
                                    </div>
                                    <input type="text" name="id" id="id" value="{{ $user->id }}" readonly="readonly" class="d-none"/>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary">Valider</button>  
                                    </div>
                                </div>
                            </form>
                            @endif
                            @endif
                        </td>
                        @endcan
                    </tr>
                </a>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
</div>
</div>
@endsection
