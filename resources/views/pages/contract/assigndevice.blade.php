@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .select2-selection__rendered {
            line-height: 33px !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
        .select2-selection__arrow {
            height: 36px !important;
        }
    </style>
@endsection

{{-- TITLE --}}
@section('title', 'Contract')

{{-- TITLE CONTENT --}}
@section('title-content', 'Contract')

{{-- CONTENT --}}
@section('content')

    <form action="{{ url('contract/updatedevice', $contract->id) }}" method="POST">
        @method('patch')
        @csrf

        <x-accordion id="myAccordion">
            @if($contract->devices->count() > 0)
                @foreach ( $contract->devices as $device )
                    <x-accordion-item header-label="Device UUID : {{ $device->uuid }}" component-id="menu-{{ $device->id }}" is-open="true">
                        <div class="col-12 rounded mb-3">
                            <div class="col-12 row" style="margin: auto 0; border-bottom: 1px solid #dee2e6; padding-bottom:10px;">
                                <div class="col-5">
                                    <input type="text" name="uuid[]" value="{{ $device->uuid }}" class="form-control" readonly>
                                    <input type="hidden" name="device_id[]" value="{{ $device->id }}" class="form-control" readonly>
                                </div>
                                <div class="col-5">
                                    <input type="text" name="alias[]" value="{{ old('alias', $device->alias) }}" class="form-control @error('alias') is-invalid @enderror"/>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-success" onclick="tambahRfid('{{ $device->id }}', '{{ $device->uuid }}'); return false;">Tambah RFID</button>
                                </div>
                            </div>
                            <input id="idf{{ $device->id }}" name="rfid_limit[{{ $device->uuid }}]" value="1" type="hidden" />
                            <div class="col-12" id="divRfidDevice{{ $device->id }}">
    
                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="col-12 py-3 mt-3 rounded" style="margin: auto 0; padding: 0 20px; border:1px solid #dee2e6;" id="divRfidDevice{{ $device->id }}-{{ $i }}">
                                    <div class="col-12 row mt-2">
                                        <div class="col-5">
                                            <select class="form-control js-example-basic-single" name="rfid_uuid[{{ $device->uuid }}][]" id="input{{ $i }}">
                                                <option value=""></option>
                                                @foreach ($rfids as $rfid)
                                                    <option value="{{ $rfid }}">
                                                        {{ $rfid }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-5">
                                            <input type="text" id="input{{ $i }}-1" class="form-control" size="40" name="rfid_tipe[{{ $device->uuid }}][]" placeholder="Posisi" disabled/>
                                        </div>
                                        <div class="col-2">
                                            <button  type="button" class="btn btn-danger" onclick="hapusElemen('#divRfidDevice{{ $device->id }}-{{ $i }}'); return false;">Hapus</button>
                                        </div>
                                    </div>
                                    <div class="col-12 row">
                                        <div class="col-4">
                                            <label for="brand" class="form-label">Brand</label>
                                            <input type="text" id="input{{ $i }}-2" name="rfid_brand[{{ $device->uuid }}][]" value="{{ old('brand') }}" class="form-control @error('brand') is-invalid @enderror" disabled/>
                                            @error('brand') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-4">
                                            <label for="buy_at" class="form-label">Buy At</label>
                                            <input type="date" id="input{{ $i }}-3" name="rfid_buyat[{{ $device->uuid }}][]" value="{{ old('buy_at') }}" class="form-control buy_at @error('buy_at') is-invalid @enderror" disabled/>
                                            @error('buy_at') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-4">
                                            <label for="kilometer_start" class="form-label">KM Start</label>
                                            <input type="text" id="input{{ $i }}-4" name="rfid_kmstart[{{ $device->uuid }}][]" value="{{ old('kilometer_start') }}" class="form-control number1 @error('kilometer_start') is-invalid @enderror" data-index="1" disabled/>
                                            @error('kilometer_start') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                    </div>         
                                    <div class="col-12 row">
                                        <div class="col-4">
                                            <label for="sn" class="form-label">SN</label>
                                            <input type="number" id="input{{ $i }}-5" name="rfid_sn[{{ $device->uuid }}][]" value="{{ old('sn') }}" class="form-control @error('sn') is-invalid @enderror" disabled/>
                                            @error('sn') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-4">
                                            <label for="expired_at" class="form-label">Expired At</label>
                                            <input type="text" id="input{{ $i }}-6" name="rfid_timelimit[{{ $device->uuid }}][]" value="{{ old('time_limit') }}" class="form-control number0 @error('time_limit') is-invalid @enderror" data-index="1" disabled/>
                                            @error('expired_at') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="col-4">
                                            <label for="kilometer_end" class="form-label">KM End</label>
                                            <input type="text" id="input{{ $i }}-7" name="rfid_kmend[{{ $device->uuid }}][]" value="{{ old('kilometer_end') }}" class="form-control number2 @error('kilometer_end') is-invalid @enderror" data-index="2" disabled/>
                                            @error('kilometer_end') <div class="text-muted">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                                @endfor 
                            </div>
                        </div>
                    </x-accordion-item>
                @endforeach
            @else
                {{-- <tr>
                    <td colspan="5" class="text-center">Data Kosong</td>
                </tr> --}}
            @endif

        </x-accordion>


            


        <div class="d-grid gap-2 mt-3">
            <button class="btn btn-primary" type="submit">
                Edit Data
            </button>
        </div>
    </form>
@endsection

{{-- MODAL --}}
@section('modal')

@endsection

{{-- JS --}}
@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script> --}}

<script language="javascript">
    var rfids = @json($rfids);

    function tambahRfid(id, uuid) {
      var idf = document.getElementById("idf"+id).value;
      let input_rfid_uuid = "";
      
      input_rfid_uuid = '<div class="col-12 py-3 mt-3 rounded" style="margin: auto 0; padding: 0 20px; border:1px solid #dee2e6;" id="divRfidDevice'+id+'-'+idf+'"><div class="col-12 row mt-2"><div class="col-5">';
      input_rfid_uuid += '<select class="form-control js-example-basic-single" name="rfid_uuid['+uuid+'][]" id="input'+idf+'"><option></option>';
      rfids.forEach(add_rfid_form);
      input_rfid_uuid += '</select></div><div class="col-5"><input type="text" class="form-control" size="40" name="rfid_tipe['+uuid+'][]" id="input'+idf+'-1" placeholder="Posisi" disabled /></div><div class="col-2"><button  type="button" class="btn btn-danger" onclick="hapusElemen(\'#divRfidDevice'+id+'-'+idf+'\'); return false;">Hapus</button></div></div><div class="col-12 row"><div class="col-4"><label for="brand" class="form-label">Brand</label><input type="text" name="rfid_brand['+uuid+'][]" id="input'+idf+'-2" value="" class="form-control" disabled /></div><div class="col-4"><label for="buy_at" class="form-label">Buy At</label><input type="date" name="rfid_buyat['+uuid+'][]" id="input'+idf+'-3" value="" class="form-control" disabled /></div><div class="col-4"><label for="kilometer_start" class="form-label">KM Start</label><input type="text" name="rfid_kmstart['+uuid+'][]" id="input'+idf+'-4" value="" class="form-control" data-index="1" disabled /></div></div><div class="col-12 row"><div class="col-4"><label for="sn" class="form-label">SN</label><input type="number" name="rfid_sn['+uuid+'][]" id="input'+idf+'-5" value="" class="form-control" disabled /></div><div class="col-4"><label for="expired_at" class="form-label">Expired At</label><input type="text" name="rfid_timelimit['+uuid+'][]" id="input'+idf+'-6" value="" class="form-control" data-index="1" disabled /></div><div class="col-4"><label for="kilometer_end" class="form-label">KM End</label><input type="text" name="rfid_kmend['+uuid+'][]" id="input'+idf+'-7" value="" class="form-control" data-index="2" disabled /></div></div></div>';
      
      $("#divRfidDevice"+ id).append(input_rfid_uuid);

      idf = (idf-1) + 2;
      document.getElementById("idf"+id).value = idf;

      function add_rfid_form(item) {
        input_rfid_uuid += '<option value="'+item+'">'+item+'</option>'; 
      }

      select2();
      select2_onSelect();
      select2_unSelect();
    }
    function hapusElemen(idf) {
      $(idf).remove();
    }
</script>

<script>
    function select2(){
        $('select').select2({
            placeholder: "Pilih RFID",
            allowClear: true
        });
    };

    function select2_onSelect(){
        $(".js-example-basic-single").on('select2:select', function (e) {
            var id = $(this).attr('id');
            // var val = $(this).val();
            var val = e.params.data.id;

            console.log(id);
            console.log(val);
            for (let i = 1; i <= 7; i++) {
                console.log('bbbb');
                $("#"+id+"-"+i).prop('disabled', false);
            }
            // $('option').prop('disabled', false);
            $(".js-example-basic-single").each(function() {
                $('select').not(this).find('option').filter(function() {
                    return this.value === val;
                }).prop('disabled', true);
            })
        });
    }
    
    function select2_unSelect() {
        $(".js-example-basic-single").on('select2:unselect', function (e) {
            var id = $(this).attr('id');
            // var val = $(this).find(':selected');
            var val = e.params.data.id;
            
            for (let i = 1; i <= 7; i++) {
                console.log('aaaa');
                $("#"+id+"-"+i).prop('disabled', true);
            }
            $(".js-example-basic-single").each(function() {
                $('select').not(this).find('option').filter(function() {
                    return this.value === val;
                }).prop('disabled', false);
            })
        });
    }

    select2();
    select2_onSelect();
    select2_unSelect();

    
    
</script>
@endsection

