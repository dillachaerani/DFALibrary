<li class="nav-item">
    <a href="{{ $action }}" class="nav-link {{ MyHelper::tab_class_active($key) }}" id="{{ $key }}-tab" data-toggle="" href="#{{ $key }}" role="tab" aria-controls="{{ $key }}" aria-selected="{{ MyHelper::tab_class_true($key) }}">{{ $name }}</a>
</li>