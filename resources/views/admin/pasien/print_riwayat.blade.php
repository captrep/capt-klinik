@extends('admin.layouts.app')

@section('content')

  <section class="section">

    <div class="section-body">
      <div class="invoice">
        <div class="invoice-print">
          <div class="row">
            <div class="col-lg-12">
              <div class="invoice-title">
                <h2>Klinik Apa Ya?</h2>
                <div class="invoice-number">Anamnesa</div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <address>
                    <strong>Identitas Pasien:</strong><br>
                      {{$pasien->nama}}<br>
                      {{$pasien->umur}} Tahun<br>
                      {{$pasien->alamat}}
                  </address>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="section-title">Riwayat Penyakit / Anamnesa</div>
              <div class="table-responsive">
                <table class="table table-striped table-hover table-md">
                    <tr>
                      <th width="40%">Diagnosis</th>
                      <th width="40%">Obat</th>
                      <th width="20%">Tanggal Pemeriksaan</th>
                    </tr>
                    @foreach ($riwayat as $key => $ri)
                    <tr>
                      <td>{{$ri->diagnosis}}</td>
                      <td>{{$ri->obat}}</td>
                      <td>{{$ri->created_at}}</td>
                    </tr>                        
                    @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
        <hr>

      </div>
    </div>
  </section>

@endsection
@push('after-script')
    <script type="text/javascript">
    window.print();
    </script>
@endpush