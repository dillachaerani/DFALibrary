@extends('layouts.auth-boxed')

@php $lang = "auth_lang"; @endphp
@section('title', MyHelper::setTitle(__("$lang.title.login")))
@section('description', __("$lang.description.login"))
@section('keywords', __("$lang.keywords.login"))

@section('css')
@endsection

@section('styles')
@endsection

@section('content')
<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">@lang('Sign In')</h1>
                    <p class="">@lang('Log in to your account to continue.')</p>
                    <div class="text-left">
                        @include('components.flash-notification')
                        @include('components.flash-notification-error')
                    </div>
                    
                    {!! Form::open(['class' => 'text-left', 'url' => route('login')]) !!}
                        <div class="form">
                            <div id="username-field" class="field-wrapper input">
                                <label for="fusername" class="text-uppercase">@lang("$lang.attributes.username")</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                {!! Form::text('username', null, [
                                    'id'            => 'fusername',
                                    'class'         => "form-control ". ($errors->has('username') ? ' is-invalid' : ''),
                                    'placeholder'   => MyHelper::generate_ph('text', __("$lang.attributes.username")),
                                    'required'
                                    ]) 
                                !!}
                                @error('username')
                                    <div class="invalid-feedback" style="display: block;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password" class="text-uppercase">@lang("$lang.attributes.password")</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                {!! Form::password('password', [
                                    'id'            => 'password',
                                    'class'         => "form-control ". ($errors->has('password') ? ' is-invalid' : ''),
                                    'placeholder'   => MyHelper::generate_ph('text', __("$lang.attributes.password")), 
                                    'required'
                                    ]) 
                                !!}
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary">@lang('Log In')</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="division mb-0">
                        <span>
                            <br>
                            <small><a href="/register" class="text-primary"><i class=""></i> @lang('Belum Punya Akun')</a></small>
                            <hr>
                            <small>
                                <strong>{{ config('app.name') }}</strong> <br>
                                <strong>Copyright 2023 © All rights reserved.</strong>
                            </small>
                        </span>
                    </div>
                </div>                    
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection

@section('custom-script')
@endsection
