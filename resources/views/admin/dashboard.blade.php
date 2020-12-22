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
                <h4>Total Dokter</h4>
              </div>
              <div class="card-body">
                {{$admin['totalDokter']}}
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
                <h4>Total<br>Staff</h4>
              </div>
              <div class="card-body">
                {{$admin['totalStaff']}}
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
                <h4>Total Pasien</h4>
              </div>
              <div class="card-body">
                {{$admin['totalPasien']}}
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
                <h4>Total Antrian</h4>
              </div>
              <div class="card-body">
                @if ($admin['antrian'] == null)
                    0
                @else
                {{$admin['antrian']}}
                @endif
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
      </div>
      <div class="row">
        <div class="col-12 mb-4">
          <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('{{asset('admin/assets/img/unsplash/hero-bg.jpg')}}');">
            <div class="hero-inner">
              <h2>Welcome, dr.{{Auth::user()->name}}!</h2>
              @if (Auth::user()->status == 'Buka')
              <p class="lead">Saat ini praktek sedang dibuka, silahkan tutup praktek apabila duitnya udh banyak.</p>
              <div class="mt-4">
                <form action="{{route('tutup.praktek')}}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-outline-black btn-lg btn-icon icon-left"><i class="fa fa-power-off"></i> Tutup Praktek</button> 
                </form>
               </div>
               @elseif (Auth::user()->status == 'Tutup')
               <p class="lead">Saat ini praktek belum dibuka, silahkan buka praktek agar dapet duit.</p>
               <div class="mt-4">
                 <form action="{{route('buka.praktek')}}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-outline-black btn-lg btn-icon icon-left"><i class="fa fa-check-square"></i> Buka Praktek</button> 
                 </form>
                </div>
                @endif
            </div>
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
                    <td></td>
                    <td></td>
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
                    <form action="{{route('selesai.antrian', $antrianAction->id)}}" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-success btn-block">Selesai</button>
                    </form>
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
              @else
                @if($antrianMenunggu->isEmpty()) 
                    <button type="submit" class="btn btn-info btn-block btn-progress mb-1">Panggil Waiting</button>
                @else
                  <form action="{{route('panggil.antrian', Auth::user()->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info btn-block mb-1">Panggil Waiting</button>
                  </form>
                @endif
                @if($antrianDilewati->isEmpty())
                    <button type="submit" class="btn btn-info btn-block btn-progress mb-1">Panggil Skipped</button>
                @else
                  <form action="{{route('panggil.skipped.antrian', Auth::user()->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-info btn-block mb-1">Panggil Skipped</button>
                  </form>
                @endif
                @if ($antrianMenunggu->isNotEmpty() && $antrianDilewati->isNotEmpty())
                  <button type="submit" class="btn btn-danger btn-block btn-progress">Hapus Antrian</button>
                @elseif ($antrianMenunggu->isEmpty() && $antrianDilewati->isEmpty() && $antrianSelesai->isEmpty())
                <button type="submit" class="btn btn-danger btn-block btn-progress">Antrian Kosong</button>
                @elseif ($antrianMenunggu->isEmpty() && $antrianDilewati->isEmpty())
                <form action="{{route('hapus.antrian', Auth::user()->id)}}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-danger btn-block">Hapus Antrian</button>
                </form>
                @endif
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
                  @foreach ($antrianSelesai as $key => $antrian)
                  <tr>
                    <td>{{$antrian->pasien->nama}}</td>
                    <td><div class="badge badge-success">{{$antrian->status}}</div></td>
                  </tr>
                  @endforeach
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      @elseif(Auth::user()->role == 'staff')
      <div class="section-header">
        <h1>Dashboard</h1>
      </div>
      <div class="row">
        <div class="col-12 mb-4">
          <div class="hero text-white hero-bg-image hero-bg-parallax" style="background-image: url('{{asset('admin/assets/img/unsplash/andre-benz-1214056-unsplash.jpg')}}');">
            <div class="hero-inner">
              <h2>Welcome, {{Auth::user()->name}}!</h2>
              <p class="lead">Ayo semangat kerja biar bisa naik haji.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4>Data pasien menunggu konfirmasi</h4>
              </div>
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table table-striped table-md">
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Umur</th>
                    <th>KTP</th>
                    <th>Jenis Kelamin</th>
                    <th>Handphone</th>
                    <th>Status</th>
                    <th style="text-align: center">Action</th>
                  </tr>
                  @foreach ($pasien as $key => $pas)
                  <tr>
                    <td>{{$pasien->firstItem()+$key}}</td>
                    <td>{{$pas->nama}}</td>
                    <td>{{$pas->umur}}</td>
                    <td>{{$pas->noktp}}</td>
                    <td>{{$pas->jenkel}}</td>
                    <td>{{$pas->nohp}}</td>
                    @if($pas->status == 'Aktif')
                      <td><div class="badge badge-success">{{$pas->status}}</div></td>
                    @else 
                      <td><div class="badge badge-warning">{{$pas->status}}</div></td> 
                    @endif
                    <td>
                      <form action="{{route('konfirmasi.pasien',$pas->id)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-icon btn-block icon-left btn-primary"><i class="far fa-check-square"></i>Konfirmasi Aktif</button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                  
                </table>
              </div>
            </div>
            <div class="card-footer text-right">
              <nav class="d-inline-block">
                <ul class="pagination mb-0">
                  {{$pasien->links()}}
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
      @endif

    </section>
  </div>
@endsection