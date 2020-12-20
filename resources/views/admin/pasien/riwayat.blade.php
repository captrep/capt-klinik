@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Riwayat Pasien')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pasien Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">{{$pasien->nama}} ({{$pasien->umur}})</h2>
        <p class="section-lead">
          {{$pasien->alamat}}</p>

        <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Simple Table</h4>
                </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped table-md">
                    <tr>
                      <th width="40%" style="text-align: center">Diagnosis</th>
                      <th width="40%" style="text-align: center">Obat</th>
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
              <div class="card-footer text-right">
                  <a href="{{route('create.riwayat.pasien', $pasien->id)}}" class="btn btn-primary">Buat Riwayat baru</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </section>
</div>
@endsection

@push('after-script')
  <script>
    $(".alert-confirm").click(function(e) {
      id = e.target.dataset.id;
  swal({
      title: 'Yakin mo diapus?',
      text: 'Kalo dah diapus, ya dianya bakal ilang dan gabakal balik lagi',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
      $(`#delete${id}`).submit();
      } else {
      swal('Oke sidata gajadi ilang!');
      }
    });
});
    </script>
@endpush