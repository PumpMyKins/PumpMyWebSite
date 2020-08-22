@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <br />
        @endif
        <div class="row">
            <div class="col">
                <button data-toggle="modal" data-target="#tokenCreate" class="btn btn-success btn-block">{{ __("Create new API Token") }}</button>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __("Create at") }}</th>
                    <th>{{ __("status") }}</th>
                    <th>{{ __("Expires at") }}</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tokens as $token)
                    <tr>
                        <td>{{ $token->created_at }}</td>
                        <td>{{ $token->revoked ? __("revoked") : __("valid") }}</td>
                        <td>{{ $token->revoked ? "" : $token->created_at }}</td></td>
                        <td>
                            @if (!$token->revoked)
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-warning btn-block" onclick="copy_to_clipboard('{{$token->accessToken}}')">{{ __("Copy to clipboard") }}</button>
                                    </div>
                                    <div class="col">
                                        <form method="post" action="{{ route('ApiManagement_revoke') }}">
                                            @csrf
                                            <input type="hidden" name="token_id" value="{{$token->id}}">
                                            <button type="submit" class="btn btn-danger btn-block">{{ __("Revoke API Token") }}</button>
                                        </form>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col">
                                        <form method="POST" action="{{ route('ApiManagement_delete') }}">
                                            @csrf
                                            <input type="hidden" name="token_id" value="{{$token->id}}">
                                            <button type="submit" class="btn btn-danger btn-block">{{ __("Delete Token") }}</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modals Create new token -->
        <div class="modal" id="tokenCreate" tabindex="-1" role="dialog" aria-labelledby="token-create-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __("Create new token") }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('ApiManagement_signup') }}">
                            @csrf
                            <input type="text" placeholder="client name" class="form-control" name="client_name">
                            <input type="password" placeholder="client secret" class="form-control" name="client_secret">
                            <button type="submit" class="btn btn-success btn-block"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection