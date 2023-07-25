@extends('layouts.app')

@php $table_name = "table-user"; $lang = "user_lang"; @endphp
@section('title', MyHelper::setTitle(__("$lang.title.index")))
@section('description', __("$lang.description.index"))
@section('keywords', __("$lang.keywords.index"))

@section('css')
<link href="{{ asset('assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('styles')
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript:void(0);">@lang('User Management')</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>@lang('Users')</span></li>
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
                            <a href="{{ action('UserController@create') }}" class="btn btn-secondary mb-1">
                                <i class="fas fa-plus"></i> @lang('Add New')
                            </a>
                        </div>
                    @endslot
                    @slot('content')
                        @component('components.dt-filter', ['action'=>action('UserController@index')])
                            @include('pages.user._index.dt-filter')
                        @endcomponent
                        @component('components.tab-link')
                            @slot('tab_link')
                                @include('components.tab-link-nav-item', [
                                    'key'    => 'all',
                                    'name'   => __('All'),
                                    'action' => action('UserController@index', ['tab' => 'all']),
                                ])
                                @if ($trash)
                                    @include('components.tab-link-nav-item', [
                                        'key'    => 'trash',
                                        'name'   => __('Trash'),
                                        'action' => action('UserController@index', ['tab' => 'trash']),
                                    ])
                                @endif
                            @endslot
                            @slot('tab_content')
                                @include('pages.user._index.dt', ['table_name' => $table_name])
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
<script src="{{asset('assets/js/components/ui-accordions.js')}}"></script>
<script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
<script>
    $("#froles").select2({
        allowClear: true,
        placeholder: "{{ MyHelper::generate_ph('select', __('user_lang.attributes.roles')) }}"
    });
</script>
@endsection

@section('custom-script')
@endsection
