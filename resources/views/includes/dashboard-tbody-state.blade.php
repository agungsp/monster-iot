@if ($device->has_door1)
    <tr>
        <td>Pintu 1</td>
        <td id="SP1">
            @if ($device->door1_state ?? 'Closed' == 'Opened')
                <span class="badge rounded-pill bg-danger">Terbuka</span>
            @else
                <span class="badge rounded-pill bg-success">Tertutup</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_door2)
    <tr>
        <td>Pintu 2</td>
        <td id="SP2">
            @if ($device->door2_state ?? 'Closed' == 'Opened')
                <span class="badge rounded-pill bg-danger">Terbuka</span>
            @else
                <span class="badge rounded-pill bg-success">Tertutup</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_door_lock)
    <tr>
        <td>Kunci Pintu</td>
        <td id="MAG">
            @if ($device->door_lock_state ?? 'Closed' == 'Opened')
                <span class="badge rounded-pill bg-danger">Tidak Terkunci</span>
            @else
                <span class="badge rounded-pill bg-success">Terkunci</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_container_weight)
    <tr>
        <td>Berat Kontainer</td>
        <td id="LC">
            1000 kg
        </td>
    </tr>
@endif
@if ($device->has_proximity)
    <tr>
        <td>Proximity</td>
        <td id="PROX">
            @if ($device->proximity_state ?? 'Unsafe' == 'Safe')
                <span class="badge rounded-pill bg-danger">Tidak Aman</span>
            @else
                <span class="badge rounded-pill bg-success">Aman</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_emergency_button)
    <tr>
        <td>Emergency Button</td>
        <td id="PB">
            @if ($device->emergency_button_state ?? 'Unsafe' == 'Safe')
                <span class="badge rounded-pill bg-danger">Tidak Aman</span>
            @else
                <span class="badge rounded-pill bg-success">Aman</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_machine)
    <tr>
        <td>Mesin</td>
        <td id="RS">
            @if ($device->machine_state ?? 'On' == 'Off')
                <span class="badge rounded-pill bg-danger">Mati</span>
            @else
                <span class="badge rounded-pill bg-success">Menyala</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_driving_behavior)
    <tr>
        <td>Driving Behaviour</td>
        <td id="DRI">
            @if ($device->driving_behavior_state ?? 'Stable' == 'Unstable')
                <span class="badge rounded-pill bg-danger">Tidak Stabil</span>
            @else
                <span class="badge rounded-pill bg-success">Stabil</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_drowsiness)
    <tr>
        <td>Drowness</td>
        <td id="DRO">
            @if ($device->drowsiness_state ?? 'Sleepy' == 'Not Sleepy')
                <span class="badge rounded-pill bg-danger">Mengantuk</span>
            @else
                <span class="badge rounded-pill bg-success">Tidak Mengantuk</span>
            @endif
        </td>
    </tr>
@endif
@if ($device->has_fuel_tank)
    <tr>
        <td>Tutup Tangki</td>
        <td id="TANK">
            @if ($device->fuel_tank_state ?? 'Closed' == 'Opened')
                <span class="badge rounded-pill bg-danger">Terbuka</span>
            @else
                <span class="badge rounded-pill bg-success">Tertutup</span>
            @endif
        </td>
    </tr>
@endif
<tr>
    <td>Latitude</td>
    <td id="LAT">
        7987459
    </td>
</tr>
<tr>
    <td>Longitude</td>
    <td id="LON">
        8754837
    </td>
</tr>
<tr>
    <td>RFID 1</td>
    <td id="rfid1"></td>
</tr>
<tr>
    <td>RFID 2</td>
    <td id="rfid2"></td>
</tr>
<tr>
    <td>RFID 3</td>
    <td id="rfid3"></td>
</tr>
<tr>
    <td>RFID 4</td>
    <td id="rfid4"></td>
</tr>
<tr>
    <td>Toogle Pintu</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-sm btn-success" onclick="lockPintu()">Lock</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="unlockPintu()">Unlock</button>
        </div>
    </td>
</tr>
<tr>
    <td>Toogle Mesin</td>
    <td>
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-sm btn-success" onclick="engineOnpub()">On</button>
            <button type="button" class="btn btn-sm btn-danger" onclick="engineOffpub()">Off</button>
        </div>
    </td>
</tr>


