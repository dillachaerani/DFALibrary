@extends('layouts.app')

@php $lang = "dashboard_lang"; @endphp
@section('title', MyHelper::setTitle(__("$lang.title.index")))
@section('description', __("$lang.description.index"))
@section('keywords', __("$lang.keywords.index"))

@section('css')
@endsection

@section('styles')
@endsection

@section('breadcrumb')
<li class="breadcrumb-item active" aria-current="page"><span>@lang('Dashboard')</span></li>
@endsection

@section('content')
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 layout-spacing">
            <h4>@lang('Dashboard')</h4>
        </div>
    </div>
</div>

@endsection

@section('script')
@include('components.welcome-message')
@endsection

@section('custom-script')
@endsection
