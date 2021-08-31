@if ($device->has_door1)
    <tr>
        <td>Pintu 1</td>
        <td id="SP1">
            <span class="badge rounded-pill bg-success">Tertutup</span>
        </td>
    </tr>
@endif
@if ($device->has_door2)
    <tr>
        <td>Pintu 2</td>
        <td id="SP2">
            <span class="badge rounded-pill bg-success">Tertutup</span>
        </td>
    </tr>
@endif
@if ($device->has_door_lock)
    <tr>
        <td>Kunci Pintu</td>
        <td id="MAG">
            <span class="badge rounded-pill bg-success">Terkunci</span>
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
            <span class="badge rounded-pill bg-success">Aman</span>
        </td>
    </tr>
@endif
@if ($device->has_emergency_button)
    <tr>
        <td>Emergency Button</td>
        <td id="PB">
            <span class="badge rounded-pill bg-success">Aman</span>
        </td>
    </tr>
@endif
@if ($device->has_machine)
    <tr>
        <td>Mesin</td>
        <td id="RS">
            <span class="badge rounded-pill bg-success">Menyala</span>
        </td>
    </tr>
@endif
@if ($device->has_driving_behavior)
    <tr>
        <td>Driving Behaviour</td>
        <td id="DRI">
            <span class="badge rounded-pill bg-success">Stabil</span>
        </td>
    </tr>
@endif
@if ($device->has_drowsiness)
    <tr>
        <td>Drowness</td>
        <td id="DRO">
            <span class="badge rounded-pill bg-success">Tidak Mengantuk</span>
        </td>
    </tr>
@endif
@if ($device->has_fuel_tank)
    <tr>
        <td>Tutup Tangki</td>
        <td id="TANK">
            <span class="badge rounded-pill bg-success">Tertutup</span>
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


