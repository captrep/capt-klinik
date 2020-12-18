@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Dashboard')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      @if (Auth::user()->role == 'admin')
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
      <div class="row">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">
              <h4>Olah data</h4>
            </div>
            <div class="card-body p-0">
              <div class="table-responsive table-invoice">
                <table class="table table-striped">
                  <tr>
                    <th width="30%" style="text-align: center">Nama Pasien</th>
                    <th width="10%">Status</th>
                    <th width="60%" style="text-align: center">Action</th>
                  </tr>
                  @if ($antrianAction->isNotEmpty())
                  @foreach ($antrianAction as $antrian)
                  <tr>
                    <td>{{$antrian->pasien->nama}}</td>
                    <td><div class="badge badge-primary">{{$antrian->status}}</div></td>
                    <td style="text-align: center">
                      
      
                      <form action="" method="POST">
                        @csrf
                        <a href="#"class="btn btn-primary">Periksa</a>
                      </form>
                      
                    </td>
                  </tr>          
                  @endforeach     
                  @else        
                  <tr>
                    <td></td>
                    <td></td>
                    <td>

                    </td>
                  </tr>          
                  @endif

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card">
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
                  
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="card">
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
                    <th>Action</th>
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
                    <td>
                      <form action="{{route('panggil.antrian',$antrian->id)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Panggil</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach

                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
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
                    <th>Action</th>
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
                    <td>none</td>
                  </tr>
                  @endforeach

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