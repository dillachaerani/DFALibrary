@extends('layouts.app')

@php $table_name = "table-role"; $lang = "role_lang"; @endphp
@section('title', MyHelper::setTitle(__("$lang.title.index")))
@section('description', __("$lang.description.index"))
@section('keywords', __("$lang.keywords.index"))

@section('css')
@endsection

@section('styles')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('User Management')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('Roles')</span></li>
@endsection

@section('content')
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-lg-12 col-12 layout-spacing">
                <div>
                    @include('components.flash-notification')
                    @include('components.flash-notification-error')
                </div>
                @component('components.widget', ['title' => __("$lang.title.index")])
                    @slot('header')
                        <!-- BUTTON ACTION -->
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <a href="{{ action('RoleController@create') }}" class="btn btn-secondary mb-1">
                                <i class="fas fa-plus"></i> @lang('Add New')
                            </a>
                        </div>
                    @endslot
                    @slot('content')
                        @component('components.tab-link')
                            @slot('tab_link')
                                @include('components.tab-link-nav-item', [
                                    'key'    => 'all',
                                    'name'   => __('All'),
                                    'action' => action('RoleController@index', ['tab' => 'all']),
                                ])
                                @if ($trash)
                                    @include('components.tab-link-nav-item', [
                                        'key'    => 'trash',
                                        'name'   => __('Trash'),
                                        'action' => action('RoleController@index', ['tab' => 'trash']),
                                    ])
                                @endif
                            @endslot
                            @slot('tab_content')
                                @include('pages.role._index.dt', ['table_name' => $table_name])
                            @endslot
                        @endcomponent
                    @endslot
                @endcomponent
            </div>
            @component('components.index-modal', ['table_name'=>$table_name])               
            @endcomponent
        </div>
    </div>
@endsection

@section('script')
@include('components.flash-notification-js')
@endsection

@section('custom-script')
@endsection
