@extends('layouts.app')

@php $lang = "app_lang"; @endphp
@section('title', MyHelper::setTitle(__("$lang.title.edit")))
@section('description', __("$lang.description.edit"))
@section('keywords', __("$lang.keywords.edit"))

@section('css')
@include('pages.app.form.form-css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/dropify/dropify.min.css')}}">
@endsection

@section('styles')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Settings')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('Application')</span></li>
@endsection

@section('content')
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            {!! Form::model($app, ['url' => action('AppSettingController@store'), 'method' => 'post', 'files'=>true])  !!}
                <div class="account-content">
                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div>
                                    @include('components.flash-notification')
                                    @include('components.flash-notification-error')
                                </div>
                                @component('components.widget', ['title' => __("$lang.title.edit")])
                                    @slot('content')
                                        <div id="general-info" class="section general-info">
                                            <div class="info">
                                                @include('pages.app.form.form')
                                            </div>
                                        </div>
                                    @endslot
                                @endcomponent
                            </div>
                        </div>
                    </div>
                </div>
                <div class="account-settings-footer">
                    <div class="as-footer-container">
                        <button class="btn btn-danger" type="reset">Reset</button>
                        <button class="btn btn-primary" type="submit">@lang('Update')</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
@include('components.flash-notification-js')
@include('pages.app.form.form-js')
<script src="{{asset('plugins/dropify/dropify.min.js')}}"></script>
<script src="{{asset('assets/js/users/account-settings.js')}}"></script>
@endsection

@section('custom-script')
@endsection
