@forelse ($devices as $device)
    <tr class="itemDevice" data-uuid="{{ $device->uuid }}" id="device.{{ $device->id }}">
        <td class="text-truncate">{{ $device->alias ?? $device->uuid }}</td>
        <td style="width: 4rem;">
            <span class="badge rounded-pill bg-success">Online</span>
        </td>
        <td style="width: 8rem;">0 min ago</td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-center">No device</td>
    </tr>
@endforelse
@if ($devices->count() < 20)
    @for ($i = 0; $i < (20 - $devices->count()); $i++)
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    @endfor
@endif
