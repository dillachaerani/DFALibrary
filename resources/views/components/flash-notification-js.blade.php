@if (session('flash_notification'))
    @include('components.alert-js', ['is_error' => session('flash_notification.is_error'), 'message' => session('flash_notification.message')])
@endif