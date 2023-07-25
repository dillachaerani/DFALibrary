@php
    if(request()->tab == "trash")
        $trash_params = ['tab' => 'trash'];
    else
        $trash_params = [];
@endphp