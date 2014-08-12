@extends('layout.main')

@section('content')
    @if( Auth::check() )
        <h1 class="page-header">Dashboard</h1>
    @else
        <div class="jumbotron">
              <div class="container">
                <h1>Welcome to Laravel Authentication!</h1>
                <p>This is a basic example of the Laravel 4 authentication system with a few basic views. In theory this is production ready, feel free to use it as you wish.</p>
                <p>
                    <a class="btn btn-primary btn-lg" role="button" href="{{ URL::route('account-create') }}">Create a Free Account »</a>
                    <a class="btn btn-default btn-lg" role="button" href="{{ URL::route('account-sign-in') }}">Sign In</a>
                </p>
              </div>
            </div>
    @endif
@stop