@extends('layouts.paneltemplate')

@section('title')

Panel

@endsection

@section('content')
    <!-- Second security for access just to be sure no one access this. -->
    @can('staff')
    <script type="text/javascript" src="{{ asset('js/sortable.js') }}"></script>
        <div class="col-6">
            <div class="card">
                <div class="card-header">Liste des candidatures</div>
                <div class="card-body">
                    <table class="table table-bordered table-hover sortable">
                        <thead>
                            <tr>
                                <th scope="col">Pseudo</th>
                                <th scope="col">Type</th>
                                <th scope="col">Date de Candidature</th>
                                <th scope="col">Status</th>
                                <th scope="col">Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($candidature as $candid)
                                <tr class="@if(strpos($candid->state, 'Refusé') !== false) table-danger @elseif(strpos($candid->state, 'Accepté') !== false) table-success @endif">
                                    <th><a href="{{ route('show_candidature', ['id' => $candid->id]) }}" class="no-style">{{ $candid->name }}</a></th>
                                    <td>{{ $candid->type }}</td>
                                    <td>{{ $candid->created_at }}</td>
                                    <td>{{ $candid->state }}</td>
                                    <td><a tabindex="0" type="" data-toggle="popover" title="<center><h5 class='votelist'>Liste des votes</h5></center>" data-html="true" data-content="
                                        <div class='row'>
                                            <div class='col'>
                                                <h6>Pour</h6>
                                                @foreach(explode(',',$candid->upvote) as $upvoter)
                                                <h6 class='upvoter'>{{ $upvoter }}</h6>
                                                @endforeach
                                            </div>
                                            <div class='col'>
                                                <h6>Contre</h6>
                                                @foreach(explode(',',$candid->downvote) as $downvoter)
                                                <h6 class='downvoter'>{{ $downvoter }}</h6>
                                                @endforeach
                                            </div>
                                        </div>" data-container="body" data-trigger="hover" class="no-style">{{ count(explode(",",$candid->upvote)) - count(explode(",",$candid->downvote)) }}</a></td>
                                </tr>
                            </a>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="test">
                        {{ $candidature->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection
