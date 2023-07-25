<tr class="text-light b-b-dark">
    <th class="nowrap" width="{{ $th_width }}">{{ $th_text }}</th>
    <th class="text-center" width="20px">:</th>
    <td class="{{ ($th_nowrap) ? 'nowrap' : '' }}">
        {{ $slot }}
    </td>
</tr>