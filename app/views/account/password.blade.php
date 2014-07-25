@extends('layout.main')

@section('content')
    <h1 class="page-header">Change Password</h1>
    <form action="{{ URL::route('account-change-password-post') }}" method="post">
        <div class="form-group<?php if( $errors->has('old_password') ) { echo ' has-error'; }?>">
            <label for="old_password">Old Password</label>
            <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password">
            @if( $errors->has('old_password') )
                <span class="help-block">{{ $errors->first('old_password') }}</span>
            @endif
        </div>
        <div class="form-group<?php if( $errors->has('password') ) { echo ' has-error'; }?>">
            <label for="password">New Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="New Password">
            @if( $errors->has('password') )
                <span class="help-block">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="form-group<?php if( $errors->has('password_again') ) { echo ' has-error'; }?>">
            <label for="password_again">New Password</label>
            <input type="password" class="form-control" id="password_again" name="password_again" placeholder="New Password Again">
            @if( $errors->has('password_again') )
                <span class="help-block">{{ $errors->first('password_again') }}</span>
            @endif
        </div>
        {{ Form::token() }}
        <input type="submit" value="Sign In" />
    </form>
@stop