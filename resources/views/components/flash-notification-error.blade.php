@if ($errors->any() || session('error'))
    @component('components.alert', [
        'color' => 'danger'
    ])
        @if ($errors->any())
            <ul class="p-0 m-0">
                @foreach ($errors->all() as $error)
                    <li class="ml-3">{{ $error }}</li>
                @endforeach
            </ul>
        @else
            {{ session('error') }}
        @endif
    @endcomponent
@endif