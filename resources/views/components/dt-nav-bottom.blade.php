<div class="form-inline d-flex mt-4">
    {{ $bulk_action }}
    <div class="ml-auto mt-2">
        @if ($data->count() > 0)
            {{ $data->links('components.pagination') }}
        @else
            @include('components.pagination-empty')
        @endif
    </div>
</div>