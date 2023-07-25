@php $table_name = "table-user"; $lang = "user_lang"; @endphp
@component('components.modal-header')
    @slot('modal_title')
        <h5 class="modal-title" id="modal_label">@lang("$lang.title.detail")</h5>
    @endslot
@endcomponent
@component('components.modal-body')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12">
        @include('pages.user.detail.detail-content')
    </div>
</div>
@endcomponent
@component('components.modal-footer', ['detail_url' => action('UserController@show', encrypt($user->id))])
    @include('pages.user.detail.detail-action')
@endcomponent