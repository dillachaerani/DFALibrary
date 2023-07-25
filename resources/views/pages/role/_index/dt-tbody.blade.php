<td class="text-center nowrap">
    {{ $data->firstItem() + $row }}
</td>
<td class="nowrap">{{ $item->name }}</td>
<td class="nowrap text-center">{{ $item->guard_name }}</td>
<td class="nowrap text-center">{{ $item->users_count }}</td>
<td class="nowrap text-center">{{ $item->permissions_count }}</td>
<td class="nowrap">{{ MyHelper::dt_column_datetime($item->created_at) }}</td>