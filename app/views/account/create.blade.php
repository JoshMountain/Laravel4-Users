@extends('layout.main')

@section('content')
    <h1 class="page-header">Create an Account</h1>
    <form action="{{ URL::route('account-create-post') }}" method="post">
        <div class="form-group<?php if( $errors->has('email') ) { echo ' has-error'; }?>">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email"{{ (Input::old('email')) ? ' value="' . e( Input::old('email') ) . '"' : '' }}>
            @if( $errors->has('email') )
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>

        <div class="form-group<?php if( $errors->has('username') ) { echo ' has-error'; }?>">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username"{{ (Input::old('username')) ? ' value="' . e( Input::old('username') ) . '"' : '' }}>
            @if( $errors->has('username') )
                <span class="help-block">{{ $errors->first('username') }}</span>
            @endif
        </div>

        <div class="form-group<?php if( $errors->has('password') ) { echo ' has-error'; }?>">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            @if( $errors->has('password') )
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>

        <div class="form-group<?php if( $errors->has('password_again') ) { echo ' has-error'; }?>">
            <label for="password_again">Password Again</label>
            <input type="password" class="form-control" id="password_again" name="password_again" placeholder="Password">
            @if( $errors->has('password_again') )
                <span class="help-block">{{ $errors->first('password_again') }}</span>
            @endif
        </div>
        {{ Form::token() }}
        <input type="submit" value="Create Account" />
    </form>
@stop