@extends('layout.main')

@section('content')
    <h1 class="page-header">Reset Password</h1>
    <form action="{{ URL::route('account-forgot-password-post') }}" method="post">
        <div class="form-group<?php if( $errors->has('email') ) { echo ' has-error'; }?>">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email address"{{ (Input::old('email')) ? ' value="' . e( Input::old('email') ) . '"' : '' }}>
            @if( $errors->has('email') )
                <span class="help-block">{{ $errors->first('email') }}</span>
            @endif
        </div>
        {{ Form::token() }}
        <input type="submit" value="Reset Password" />
    </form>
@stop