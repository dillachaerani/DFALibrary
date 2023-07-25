@component('components.detail-btn-action', [
    'table_name'  => $table_name,
    'lang'        => $lang,
    'name'        => $role->name,
    'edit_url'    => action('RoleController@edit', encrypt($role->id)),
    'delete_url'  => action('RoleController@destroy', encrypt($role->id)),
    'restore_url' => $role->deleted_at ? action('RoleController@restore', encrypt($role->id)) : null,
])
    @include('pages.role._index.dt-item-action', ['item'=>$role])
@endcomponent