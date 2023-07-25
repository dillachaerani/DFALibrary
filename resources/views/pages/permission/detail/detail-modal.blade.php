@php $table_name = "table-permission"; $lang = "permission_lang"; @endphp
@component('components.modal-header')
    @slot('modal_title')
        <h5 class="modal-title" id="modal_label">@lang("$lang.title.detail")</h5>
    @endslot
@endcomponent
@component('components.modal-body')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        @include('pages.permission.detail.detail-content')
    </div>
</div>
@endcomponent
@component('components.modal-footer', ['detail_url' => action('PermissionController@show', encrypt($permission->id))])
    @include('pages.permission.detail.detail-action')
@endcomponent