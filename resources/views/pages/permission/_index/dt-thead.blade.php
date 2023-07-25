<th class="nowrap text-center align-middle" style="width: 50px;max-width: 60px;">
    {!! MyHelper::table_generate_th('NO', 'id') !!}
</th>
<th class="nowrap align-middle">
    {!! MyHelper::table_generate_th(__("$lang.attributes.name"), 'name') !!}
</th>
<th class="nowrap align-middle text-center">
    {!! MyHelper::table_generate_th(__("$lang.attributes.guard_name"), 'guard_name') !!}
</th>
<th class="nowrap align-middle text-center">
    {!! MyHelper::table_generate_th(__("$lang.attributes.roles_count"), 'roles_count') !!}
</th>
<th class="align-middle">
    {!! MyHelper::table_generate_th(__('Date Created'), 'created_at') !!}
</th>