@extends('layouts.app')

@php $lang = "role_lang"; @endphp
@section('title', MyHelper::setTitle(__("$lang.title.create")))
@section('description', __("$lang.description.create"))
@section('keywords', __("$lang.keywords.create"))

@section('css')
@include('pages.role.form.form-css')
@endsection

@section('styles')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('User Management')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('Roles')</span></li>
@endsection

@section('content')
    <div class="layout-px-spacing">
        <div class="account-settings-container layout-top-spacing">
            {!! Form::open(['method' => 'POST', 'url' => action('RoleController@store')]) !!}
                <div class="account-content">
                    <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                <div>
                                    @include('components.flash-notification')
                                    @include('components.flash-notification-error')
                                </div>
                                @component('components.widget', ['title' => __("$lang.title.create")])
                                    @slot('content')
                                        <div id="general-info" class="section general-info">
                                            <div class="info">
                                                @include('pages.role.form.form')
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
                        <button class="btn btn-primary" type="submit">@lang('Save')</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
@include('components.flash-notification-js')
@include('pages.role.form.form-js')
@endsection

@section('custom-script')
@endsection
