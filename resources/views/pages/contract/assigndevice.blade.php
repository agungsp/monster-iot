@extends('layouts.main')

{{-- META --}}
@section('meta')

@endsection

{{-- CSS --}}
@section('css')

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


        <div class="accordion" id="accordionPanelsStayOpenExample">
            @if($contract->devices->count() > 0)
                @foreach ( $contract->devices as $device )
            <div class="accordion-item">
              <h2 class="accordion-header" id="panelsStayOpen-heading{{ $device->id }}">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{ $device->id }}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{ $device->id }}">
                  Device UUID : {{ $device->uuid }} 
                </button>
              </h2>
              <div id="panelsStayOpen-collapse{{ $device->id }}" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading{{ $device->id }}">
                <div class="accordion-body">
                    <div class="col-12 rounded mb-3">
                        <div class="col-12 row" style="margin: auto 0; border-bottom: 1px solid #dee2e6; padding-bottom:10px;">
                            <div class="col-5">
                                <input type="text" name="uuid[]" value="{{ $device->uuid }}" class="form-control" readonly>
                            </div>
                            <div class="col-5">
                                <input type="text" name="alias[]" value="{{ old('alias', $device->alias) }}" class="form-control @error('alias') is-invalid @enderror"/>
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-success" onclick="tambahRfid('{{ $device->id }}', '{{ $device->uuid }}'); return false;">Tambah RFID</button>
                            </div>
                        </div>
                        <input id="idf{{ $device->id }}" name="{{ $device->uuid }}" value="5" type="hidden" />
                        <div class="col-12" id="<?php echo 'divRfidDevice'.$device->id ?>">

                            @for ($i = 1; $i <= 4; $i++)
                                <div class="col-12 py-3 mt-3 rounded" style="margin: auto 0; padding: 0 20px; border:1px solid #dee2e6;" id="divRfidDevice{{ $device->id }}-{{ $i }}">
                                <div class="col-12 row mt-2">
                                    <div class="col-5">
                                        <input type="text" class="form-control" size="40" name="rfid_uuid[]" placeholder="UUID RFID {{ $i }}" />
                                    </div>
                                    <div class="col-5">
                                        <input type="text" class="form-control" size="40" name="rfid_posisi[]" placeholder="Posisi" />
                                    </div>
                                    <div class="col-2">
                                        <button  type="button" class="btn btn-danger" onclick="hapusElemen('#divRfidDevice{{ $device->id }}-{{ $i }}'); return false;">Hapus</button>
                                    </div>
                                </div>
                                <div class="col-12 row">
                                    <div class="col-4">
                                        <label for="brand" class="form-label">Brand</label>
                                        <input type="text" name="brand" value="{{ old('brand') }}" class="form-control @error('brand') is-invalid @enderror"/>
                                        @error('brand') <div class="text-muted">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="buy_at" class="form-label">Buy At</label>
                                        <input type="date" name="buy_at" value="{{ old('buy_at') }}" class="form-control buy_at @error('buy_at') is-invalid @enderror"/>
                                        @error('buy_at') <div class="text-muted">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="kilometer_start" class="form-label">KM Start</label>
                                        <input type="text" name="kilometer_start" value="{{ old('kilometer_start') }}" class="form-control number1 @error('kilometer_start') is-invalid @enderror" data-index="1"/>
                                        @error('kilometer_start') <div class="text-muted">{{ $message }}</div> @enderror
                                    </div>
                                </div>         
                                <div class="col-12 row">
                                    <div class="col-4">
                                        <label for="sn" class="form-label">SN</label>
                                        <input type="number" name="sn" value="{{ old('sn') }}" class="form-control @error('sn') is-invalid @enderror"/>
                                        @error('sn') <div class="text-muted">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="expired_at" class="form-label">Expired At</label>
                                        <input type="text" name="time_limit" value="{{ old('time_limit') }}" class="form-control number0 @error('time_limit') is-invalid @enderror" data-index="1"/>
                                        @error('expired_at') <div class="text-muted">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="kilometer_end" class="form-label">KM End</label>
                                        <input type="text" name="kilometer_end" value="{{ old('kilometer_end') }}" class="form-control number2 @error('kilometer_end') is-invalid @enderror" data-index="2"/>
                                        @error('kilometer_end') <div class="text-muted">{{ $message }}</div> @enderror
                                    </div>
                                </div>
                            </div>
                            @endfor
                            
                        </div>
                        
                    </div>
                </div>
              </div>
            </div>
                @endforeach
            @else
                {{-- <tr>
                    <td colspan="5" class="text-center">Data Kosong</td>
                </tr> --}}
            @endif
        </div>

            


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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script> --}}
<script language="javascript">
    function tambahRfid(id, uuid) {
      var idf = document.getElementById("idf"+id).value;
      var input_rfid_uuid = "";
      
      input_rfid_uuid = '<div class="col-12 py-3 mt-3 rounded" style="margin: auto 0; padding: 0 20px; border:1px solid #dee2e6;" id="divRfidDevice'+id+'-'+idf+'"><div class="col-12 row mt-2"><div class="col-5"><input type="text" class="form-control" size="40" name="rfid_uuid[]" placeholder="UUID RFID '+idf+'" /></div><div class="col-5"><input type="text" class="form-control" size="40" name="rfid_posisi[]" placeholder="Posisi" /></div><div class="col-2"><button  type="button" class="btn btn-danger" onclick="hapusElemen(\'#divRfidDevice'+id+'-'+idf+'\'); return false;">Hapus</button></div></div><div class="col-12 row"><div class="col-4"><label for="brand" class="form-label">Brand</label><input type="text" name="brand" value="" class="form-control"/></div><div class="col-4"><label for="buy_at" class="form-label">Buy At</label><input type="date" name="buy_at" value="" class="form-control" /></div><div class="col-4"><label for="kilometer_start" class="form-label">KM Start</label><input type="text" name="kilometer_start" value="" class="form-control" data-index="1"/></div></div><div class="col-12 row"><div class="col-4"><label for="sn" class="form-label">SN</label><input type="number" name="sn" value="" class="form-control"/></div><div class="col-4"><label for="expired_at" class="form-label">Expired At</label><input type="text" name="time_limit" value="" class="form-control" data-index="1"/></div><div class="col-4"><label for="kilometer_end" class="form-label">KM End</label><input type="text" name="kilometer_end" value="" class="form-control" data-index="2"/></div></div></div>';
      
      $("#divRfidDevice"+ id).append(input_rfid_uuid);
    //   $("#divHobi"+ id +"-2").append(input_posisi);
    //   $("#divHobi"+ id +"-3").append(btn_delete);

      idf = (idf-1) + 2;
      document.getElementById("idf"+id).value = idf;
    }
    function hapusElemen(idf) {
      $(idf).remove();
    //   $(idf).remove();
    //   $(idf).remove();

    }
</script>
@endsection

