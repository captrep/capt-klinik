@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Dashboard')
@section('content')
<div class="main-content">
    <section class="section">
      @if (Auth::user()->role == 'admin')
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Admin</h4>
              </div>
              <div class="card-body">
               2
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>News</h4>
              </div>
              <div class="card-body">
                42
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4></h4>
              </div>
              <div class="card-body">
                1,201
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Online Users</h4>
              </div>
              <div class="card-body">
                47
              </div>
            </div>
          </div>
        </div>                  
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Antrian</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Status</th>
                    <th>Dokter</th>
                    <th>Dibuat Pada</th>
                  </tr>
                  @foreach ($antrianAll as $key  => $antrian)
                  <tr>
                    <td>{{$antrianAll->firstItem()+$key}}</td>
                    <td class="font-weight-600">{{$antrian->pasien->nama}}</td>
                      @if ($antrian->status == 'Menunggu')
                        <td><div class="badge badge-info">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Dilewati')
                        <td><div class="badge badge-warning">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Diperiksa')
                        <td><div class="badge badge-primary">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Selesai')
                        <td><div class="badge badge-success">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Dipanggil')
                      <td><div class="badge badge-secondary">{{$antrian->status}}</div></td>
                      @endif
                    <td>{{$antrian->user->name}}</td>
                    <td>{{$antrian->created_at->format('d M Y, H:i')}} WIB</td>
                  </tr>
                  @endforeach

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @elseif(Auth::user()->role == 'dokter')
      <div class="section-header">
        <h1>Dashboard</h1>
        <div class="section-header-breadcrumb">
          <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">Buka Praktek</button>
            <button type="button" class="btn btn-danger">Tutup Praktek</button>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-9">
          <div class="card card-info">
            <div class="card-header">
              <h4>Olah data</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th style="text-align: center">Nama Pasien</th>
                    <th >Status</th>
                  </tr>
                  @if ($antrianAction != null)
                  <tr>
                    <td><a href="">{{$antrianAction->pasien->nama}}</a></td>
                    <td><div class="badge badge-primary">{{$antrianAction->status}}</div></td>
                  </tr>          
                  @else        
                  <tr>
                    <td>xxxxxxxxxxx</td>
                    <td>xxxxxxxxxxx</td>
                  </tr>          
                  @endif

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3">
          <div class="card card-primary">
            <div class="card-header">
              <h4>Action</h4>
            </div>
            <div class="card-body">
              @if ($antrianAction != null)
                @if ($antrianAction->status == 'Diperiksa')
                    {{-- ilangin button periksa + lewati --}}
                @else
                  <form action="{{route('periksa.antrian', $antrianAction->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary btn-block mb-1">Periksa</button>
                  </form>
                  <form action="{{route('lewati.antrian', $antrianAction->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning btn-block mb-1">Lewati</button>
                  </form>
                @endif
              <form action="{{route('selesai.antrian', $antrianAction->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success btn-block">Selesai</button>
              </form>
              @else 
              <form action="{{route('panggil.antrian', Auth::user()->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-info btn-block mb-1">Panggil Waiting</button>
              </form>
              <form action="{{route('panggil.skipped.antrian', Auth::user()->id)}}" method="POST">
                @csrf
                <button type="submit" class="btn btn-info btn-block">Panggil Skipped</button>
              </form>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-5">
          <div class="card card-info">
            <div class="card-header">
              <h4>Waiting Queue</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Status</th>
                  </tr>
                  @foreach ($antrianMenunggu as $key  => $antrian)
                  <tr>
                    <td>{{$antrianMenunggu->firstItem()+$key}}</td>
                    <td class="font-weight-600">{{$antrian->pasien->nama}}</td>
                      @if ($antrian->status == 'Menunggu')
                        <td><div class="badge badge-info">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Dilewati')
                        <td><div class="badge badge-warning">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Diperiksa')
                        <td><div class="badge badge-primary">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Selesai')
                        <td><div class="badge badge-success">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Dipanggil')
                      <td><div class="badge badge-primary">{{$antrian->status}}</div></td>
                      @endif
                  </tr>
                  @endforeach

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card card-warning">
            <div class="card-header">
              <h4>Skipped Queue</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th>#</th>
                    <th>Nama Pasien</th>
                    <th>Status</th>
                  </tr>
                  @foreach ($antrianDilewati as $key  => $antrian)
                  <tr>
                    <td>{{$antrianDilewati->firstItem()+$key}}</td>
                    <td class="font-weight-600">{{$antrian->pasien->nama}}</td>
                      @if ($antrian->status == 'Menunggu')
                        <td><div class="badge badge-info">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Dilewati')
                        <td><div class="badge badge-warning">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Diperiksa')
                        <td><div class="badge badge-primary">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Selesai')
                        <td><div class="badge badge-success">{{$antrian->status}}</div></td>
                      @elseif($antrian->status == 'Dipanggil')
                      <td><div class="badge badge-secondary">{{$antrian->status}}</div></td>
                      @endif
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card card-success">
            <div class="card-header">
              <h4>Selesai diperiksa</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th width="30%" style="text-align: center">Nama Pasien</th>
                    <th width="10%">Status</th>
                  </tr>
                  @if ($antrianSelesai->isNotEmpty())
                  @foreach ($antrianSelesai as $key => $antrian)
                  <tr>
                    <td>{{$antrian->pasien->nama}}</td>
                    <td><div class="badge badge-success">{{$antrian->status}}</div></td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td>xxxxxxxxxxx</td>
                    <td>xxxxxxxxxxx</td>
                  </tr>
                  @endif
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

    </section>
  </div>
@endsection