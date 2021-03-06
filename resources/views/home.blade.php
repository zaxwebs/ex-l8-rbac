@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your Permissions as a {{ auth()->user()->presentRole() }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <ul>
                        @foreach ($permissions as $permission => $roles)
                        @can($permission)
                        <li> {{ $permission }}</li>
                        @endcan
                        @endforeach
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection