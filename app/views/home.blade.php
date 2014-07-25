@extends('layout.main')

@section('content')
    @if( Auth::check() )
        <h1 class="page-header">Dashboard</h1>
    @else
        <div class="jumbotron">
              <div class="container">
                <h1>Welcome to Item Manager!</h1>
                <p>Item Manager is web application built to manage a list of items and assign a status to each item.</p>
                <p>Ever wanted to track which Steam games you have completed or which products you are still waiting to ship?</p>
                <p>Item Manager was designed to be a free, lightweight item tracking tool.</p>
                <p>
                    <a class="btn btn-primary btn-lg" role="button" href="{{ URL::route('account-create') }}">Create a Free Account »</a>
                    <a class="btn btn-default btn-lg" role="button" href="{{ URL::route('account-sign-in') }}">Sign In</a>
                </p>
              </div>
            </div>
    @endif
@stop