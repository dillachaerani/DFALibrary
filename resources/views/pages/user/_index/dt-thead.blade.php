<th class="nowrap text-center align-middle" style="width: 50px;max-width: 60px;">
    {!! MyHelper::table_generate_th('NO', 'id') !!}
</th>
<th class="nowrap align-middle text-center">
    {!! MyHelper::table_generate_th(__("$lang.attributes.avatar"), 'avatar') !!}
</th>
<th class="nowrap align-middle">
    {!! MyHelper::table_generate_th(__("$lang.attributes.username"), 'username') !!}
</th>
<th class="nowrap align-middle">
    {!! MyHelper::table_generate_th(__("$lang.attributes.name"), 'name') !!}
</th>
<th class="nowrap align-middle">
    {!! MyHelper::table_generate_th(__("$lang.attributes.email"), 'email') !!}
</th>
<th class="nowrap align-middle">
    {!! MyHelper::table_generate_th(__("$lang.attributes.is_active"), 'is_active') !!}
</th>
<th class="nowrap align-middle">
    {!! MyHelper::table_generate_th(__("$lang.attributes.roles"), 'roles_count') !!}
</th>
<th class="align-middle">
    {!! MyHelper::table_generate_th(__('Date Created'), 'created_at') !!}
</th>