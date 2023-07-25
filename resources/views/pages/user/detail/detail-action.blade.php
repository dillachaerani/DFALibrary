@component('components.detail-btn-action', [
    'table_name'  => $table_name,
    'lang'        => $lang,
    'name'        => $user->name,
    'edit_url'    => action('UserController@edit', encrypt($user->id)),
    'delete_url'  => action('UserController@destroy', encrypt($user->id)),
    'restore_url' => $user->deleted_at ? action('UserController@restore', encrypt($user->id)) : null,
])
    @include('pages.user._index.dt-item-action', ['item'=>$user])
@endcomponent