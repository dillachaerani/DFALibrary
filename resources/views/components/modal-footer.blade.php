<div class="modal-footer justify-content-between">
    <div>
        @isset($detail_url)
            <a href="{{ $detail_url }}" class="btn btn-dark mb-1"> @lang('Detail')</a>
        @endisset
        {{ $slot }}
    </div>
    <button class="btn" data-dismiss="modal">X @lang('Close')</button>
</div>