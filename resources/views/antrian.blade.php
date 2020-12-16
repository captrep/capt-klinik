@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')
@section('title','Antrian &mdash; Klinik') 
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
            <h2>Daftar Antrian</h2>
            <p>Apabila anda belum mendaftar di klinik ini, maka anda harus mendaftar terlebih dahulu <a href="{{route('register.pasien')}}">disini</a></p>
          </div>
    


          
      </div>
    </section>

  </main><!-- End #main -->
  @endsection
