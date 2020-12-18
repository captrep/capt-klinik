@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')
@section('title','Antrian') 
@section('content')
  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Antrian Page</h2>
          <ol>
            <li><a href="{{route('welcome')}}">Home</a></li>
            <li>Antrian Page</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="appointment inner-page" id="appointment">
      <div class="container">
        <div class="section-title">
            <h2>Daftar Antrian Dokter</h2>
            <p>Pasien yang dipanggil akan ditunggu selama 5 menit, apabila tidak hadir maka akan dilewati.</p>
          </div>
      </div>
    
    <div class="container">
      <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header">
              <div class="text-center"><h5>Ini Yang Dipanggil</h5></div>
            </div>
            <div class="card-body">
              <div class="text-center">
                <h5><span class="badge badge-info">{{$antrianDipanggil == null ? '----' : $antrianDipanggil->pasien->nama}}</span></h5>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header">
              <div class="text-center"><h5>Sedang diperiksa</h5></div>
            </div>
            <div class="card-body">
              <div class="text-center">
                <h5><span class="badge badge-info">Dadang santoso</span></h5>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-4 mb-3">
          <div class="card">
            <div class="card-header">
              <h5>List Antrian Belum Dipanggil</h5>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($antrianMenunggu as $key  => $antrian)
                  <tr>
                    <th scope="row">{{$antrianMenunggu->firstItem()+$key}}</th>
                    <td>{{$antrian->pasien->nama}}</td>
                    <td><span class="badge badge-primary">{{$antrian->status}}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h5>List Antrian Yang Dilewati</h5>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($antrianDilewati as $key  => $antrian)
                  <tr>
                    <th scope="row">{{$antrianDilewati->firstItem()+$key}}</th>
                    <td>{{$antrian->pasien->nama}}</td>
                    <td><span class="badge badge-warning">{{$antrian->status}}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h5>List Antrian Selesai</h5>
            </div>
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($antrianDilewati as $key  => $antrian)
                  <tr>
                    <th scope="row">{{$antrianDilewati->firstItem()+$key}}</th>
                    <td>{{$antrian->pasien->nama}}</td>
                    <td><span class="badge badge-warning">{{$antrian->status}}</span></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  </main><!-- End #main -->
  @endsection
