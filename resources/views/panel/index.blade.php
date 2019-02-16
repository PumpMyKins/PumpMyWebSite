@extends('layouts.paneltemplate')

@section('title')

Panel

@endsection

@section('content')
        <div class="col-6">
            <div class="card">
                <div class="card-header">Panel</div>
                <div class="card-body">
                    <p>Bienvenue sur le panel joueur / staff, depuis celui-ci vous pourrez bientôt gerez vos pseudos personnalisés, votre niveau sur la communauté et bien plus.</p>
                    @can('can_mute')
                        <p>Si tu vois cela, tu es du staff, ici tu peux mute, ban et gerez les joueurs, pour le moment seulement pour le site et bientôt pour le serveurs aussi.</p>
                    @endcan
                    @can('can_promote')
                        <p>Si tu vois cela, tu es Responsable du staff, ainsi tu peux via la liste des staff, promote / demote et supprimer des staff. Utilise cela à bonne escient.</p>
                    @endcan
                </div>
            </div>
        </div>
@endsection
