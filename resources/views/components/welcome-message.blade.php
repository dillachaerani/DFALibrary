@if (session('welcome_message'))
    @include('components.alert-sb', ['is_error' => session('welcome_message.is_error'), 'message' => session('welcome_message.message')])
@endif