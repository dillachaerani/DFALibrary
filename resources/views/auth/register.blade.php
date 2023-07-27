@extends('layouts.auth-boxed')

@php $lang = "auth_lang"; @endphp

@section('css')
@endsection

@section('styles')
@endsection

<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">@lang('Sign Up')</h1>
                    <p class="">@lang('Sign Up to your account.')</p>
                    <div class="text-left">
                        @include('components.flash-notification')
                        @include('components.flash-notification-error')
                    </div>
                    
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="d-sm-flex justify-content-between">
                            <div class="field-wrapper">
                                <button type="submit" class="btn btn-primary">@lang('Register')</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <div class="division mb-0">
                            <span>
                                <br>
                                <small><a href="/login" class="text-primary"><i class=""></i> @lang('Sudah Punya Akun')</a></small>
                                <hr>
                                <small>
                                    <strong>{{ config('app.name') }}</strong> <br>
                                    <strong>Copyright 2023 © All rights reserved.</strong>
                                </small>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- @endsection --}}
