@forelse ($devices as $device)
    <tr class="itemDevice" data-uuid="{{ $device->uuid }}" id="device.{{ $device->id }}">
        <td style="width: 1rem;">
            <input type="checkbox" name="form-checkbox" id="">
        </td>
        <td style="width: 8rem;" class="text-truncate">{{ $device->alias ?? $device->uuid }}</td>
        <td style="width: 4rem;">
            <i class="fas fa-check-circle text-success"></i>
        </td>
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
