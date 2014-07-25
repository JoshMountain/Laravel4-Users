@extends('layout.main')

@section('content')
    <h1 class="page-header">Sign In</h1>
    <form action="{{ URL::route('account-sign-in-post') }}" method="post">
        <div class="form-group<?php if( $errors->has('email') ) { echo ' has-error'; }?>">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email"{{ (Input::old('email')) ? ' value="' . e( Input::old('email') ) . '"' : '' }}>
            @if( $errors->has('email') )
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div class="form-group<?php if( $errors->has('password') ) { echo ' has-error'; }?>">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            @if( $errors->has('password') )
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group">
            <label for="remember">Stay signed in</label>
            <input type="checkbox" name="remember" id="remember" />
        </div>
        {{ Form::token() }}
        <input type="submit" value="Sign In" />
    </form>
    <p>
        <br/>
        <a href="{{ URL::route('account-forgot-password') }}">Forgot Password?</a>
    </p>
@stop