@if ($value)
    <span id="{{ $target }}">{{ $value}}</span>
    <div class="mt-1">
        <a class="btn-sm mb-1 btn-dark btn-copy" href="javascript:void(0)" data-clipboard-action="copy" data-clipboard-target="#{{ $target }}"><i class="fas fa-copy"></i> @lang('Copy')</a>
    </div>
@endif