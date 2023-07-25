@component('components.detail-btn-action', [
    'table_name'  => $table_name,
    'lang'        => $lang,
    'name'        => $permission->name,
    'edit_url'    => action('PermissionController@edit', encrypt($permission->id)),
    'delete_url'  => action('PermissionController@destroy', encrypt($permission->id)),
    'restore_url' => $permission->deleted_at ? action('PermissionController@restore', encrypt($permission->id)) : null,
])
    @include('pages.permission._index.dt-item-action', ['item'=>$permission])
@endcomponent