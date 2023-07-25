<td class="text-center nowrap">
    {{ $data->firstItem() + $row }}
</td>
<td class="nowrap text-center">
    @if ($item->avatar)
        <img alt="avatar" src="{{ asset('storage/uploads/users/thumbnail/40/'.$item->avatar) }}" class="img-fluid" />
    @else
        <div class="avatar avatar-sm">
            <span class="avatar-title rounded-circle">{{ MyHelper::get_initial_name($item->username) }}</span>
        </div>
    @endif
</td>
<td class="nowrap">{{ $item->username }}</td>
<td class="nowrap">{{ $item->name }}</td>
<td class="nowrap">
    {{ $item->email }}
    {!! MyHelper::icon_verified($item->email_verified_at) !!}
</td>
<td class="nowrap">
    {!! MyHelper::badge_active($item->is_active) !!}
</td>
<td class="nowrap">
    <ul class="p-0 m-0">
        @foreach ($item->roles as $role)
            <li class="ml-3">
                {{ $role->name }}
            </li>
        @endforeach
    </ul>
</td>
<td class="nowrap">{{ MyHelper::dt_column_datetime($item->created_at) }}</td>