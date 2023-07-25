@if (MyHelper::tab_class_active_true('trash'))
    @component('components.dt-bulk-action-selected', [
        'delete_url'  => action('RoleController@destroySelected'),
        'delete_msg'  => __("$lang.messages.delete_force.selected.alert"),
        'restore_url' => action('RoleController@restoreSelected'),
        'restore_msg' => __("$lang.messages.restore.selected.alert"),
        'child'       => "item-$table_name",
    ])
        @include('pages.role._index.dt-bulk-action-selected-options')
    @endcomponent    
@else
    @component('components.dt-bulk-action-selected', [
        'delete_url'  => action('RoleController@destroySelected'),
        'delete_msg'  => $trash ? __("$lang.messages.delete.selected.alert") : __("$lang.messages.delete_force.selected.alert"),
        'child'       => "item-$table_name",
    ])
        @include('pages.role._index.dt-bulk-action-selected-options')
    @endcomponent
@endif