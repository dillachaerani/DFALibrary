@if ($type == "image")
    <img class="img-fluid" src="{{ $file }}" alt="{{ $name }}" />
@endif
<div class="mt-2">
    @isset($view_file)
        <a href="{{ $view_file }}" target="_blank" class="btn-sm mr-1 btn-dark">
            <i class="fas fa-eye"></i> @lang('View')
        </a>
    @endisset
    @isset($download_file)
        <a href="{{ $download_file }}" class="btn-sm mr-1 btn-success" download>
            <i class="fas fa-download"></i> @lang('Download')
        </a>
    @endisset
</div>