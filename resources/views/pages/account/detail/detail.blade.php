@extends('layouts.app')

@php $table_name = "table-account"; $lang = "account_lang"; @endphp
@section('title', MyHelper::setTitle(__("$lang.title.detail")))
@section('description', __("$lang.description.detail"))
@section('keywords', __("$lang.keywords.detail"))

@section('css')
<link href="{{ asset('assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('styles')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="javascript:void(0);">@lang('Settings')</a></li>
<li class="breadcrumb-item active" aria-current="page"><span>@lang('My Account')</span></li>
@endsection

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-12 layout-spacing">
                <div>
                    @include('components.flash-notification')
                    @include('components.flash-notification-error')
                </div>
                @component('components.widget', ['title' => __("$lang.title.detail")])
                    @slot('header')
                        <!-- BUTTON ACTION -->
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            @include('pages.account.detail.detail-action')
                        </div>
                    @endslot
                    @slot('content')
                        @include('pages.account.detail.detail-content')
                    @endslot
                @endcomponent
            </div>
        </div>
    </div>
@endsection

@section('script')
@include('components.flash-notification-js')
@endsection

@section('custom-script')
@endsection
