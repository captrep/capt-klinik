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
            <p>Apabila anda belum mendaftar di klinik ini, maka anda harus mendaftar terlebih dahulu <a href="{{route('register.pasien')}}">disini</a></p>
          </div>
      </div>
    </section>

      <section id="counts" class="counts">
        <div class="container">
    
          <div class="row">
    
            <div class="col-lg-3 col-md-6">
              <div class="count-box">
                <i class="icofont-doctor-alt"></i>
                <span data-toggle="counter-up">85</span>
                <p>Doctors</p>
              </div>
            </div>
    
            <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
              <div class="count-box">
                <i class="icofont-patient-bed"></i>
                <span data-toggle="counter-up">18</span>
                <p>Departments</p>
              </div>
            </div>
    
            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <i class="icofont-laboratory"></i>
                <span data-toggle="counter-up">8</span>
                <p>Research Labs</p>
              </div>
            </div>
    
            <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
              <div class="count-box">
                <i class="icofont-award"></i>
                <span data-toggle="counter-up">150</span>
                <p>Awards</p>
              </div>
            </div>
    
          </div>
    
        </div>
      </section><!-- End Counts Section -->

    <section class="appointment inner-page">
    <div class="container">
      <div class="row">
        <div class="col-md-6 mb-3">
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
        <div class="col-md-6">
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
      </div>
    </div>
  </section>
  </main><!-- End #main -->
  @endsection
