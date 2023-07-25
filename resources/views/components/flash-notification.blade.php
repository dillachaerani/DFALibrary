@if (session('flash_notification'))
    @component('components.alert', [
        'color' => 'info'
    ])
        @if (session('flash_notification.items'))
            <i class="far fa-hand-point-right mb-2"></i> {{ session('flash_notification.message') }}.
        @else
            @if (session('flash_notification.is_error'))
                <span class="badge badge-danger text-light"><i class="far fa-times-circle"></i> {{ session('flash_notification.message') }}.</span>
            @else
                <span class="badge badge-info text-light"><i class="far fa-check-circle"></i> {{ session('flash_notification.message') }}.</span>
            @endif
        @endif
        @forelse (session('flash_notification.items') as $item)
            <div class="ml-3 mb-1">
                @if ($item['is_error'])
                    <span class="badge badge-danger text-light"><i class="far fa-times-circle"></i> {{ $item['message'] }}.</span>
                @else
                    <span class="badge badge-info text-light"><i class="far fa-check-circle"></i> {{ $item['message'] }}.</span>
                @endif
            </div>
        @empty
        @endforelse
    @endcomponent
@endif