@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')
@section('title','Appointment &mdash; Klinik') 
@section('content')
  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Appointment Page</h2>
          <ol>
            <li><a href="{{route('welcome')}}">Home</a></li>
            <li>Appointment Page</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="appointment inner-page" id="appointment">
      <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-md-8">
                @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                  <div class="text-center"><h4 class="alert-heading">BERHASIL!</h4></div>
                  <hr>
                  <p>Silahkan menunggu panggilan antrian, untuk informasi antrian bisa dilihat <a href="{{route('list.antrian')}}">disini.</a></p>
                </div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger" role="alert">
                  <div class="text-center"><h4 class="alert-heading">GAGAL</h4></div>
                  <hr>
                  <p>Sistem kami tidak dapat menemukan data anda, pastikan anda telah mendaftar sebagai pasien. Apabila belum mendaftar silahkan mendaftar terlebih dahulu <a href="{{route('register.pasien')}}">disini</a> </p>
                </div>
                @endif
              </div>
          </div>


        <div class="section-title">
            <h2>Buat janji</h2>
            <p>Apabila anda belum mendaftar di klinik ini, maka anda harus mendaftar terlebih dahulu <a href="{{route('register.pasien')}}">disini</a></p>
          </div>
    
          <form action="{{route('store.antrian')}}"  method="post">
            @csrf
              <div class="form-row justify-content-md-center">
                  <div class="col-md-4 form-group">
                      <input type="text" class="form-control @error('noktp') is-invalid @enderror" name="noktp" id="noktp" value="{{old('noktp')}}" placeholder="Isi dengan nomor ktp pasien">
                      @error('noktp')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                      @enderror
                  </div>
                  <div class="col-md-4 form-group">
                    <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                    <option value="">Pilih Dokter</option>
                    @foreach ($dokter as $dr)
                        @if ($dr->username == 'dokter1')
                            {{$stat = "disabled"}}
                            {{$msg = "(Dokter belum datang)"}}
                        @else
                            {{$stat = ""}}
                            {{$msg = ""}}
                        @endif
                    <option value="{{$dr->id}}" {{$stat}}>{{$dr->name}} {{$msg}}</option>
                    @endforeach
                    </select>
                    @error('user_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
              </div>
                <div class="row justify-content-md-center">
                  <div class="col-md-8">
                    <button type="submit" class="btn btn-primary btn-block">Buat Janji</button>
                  </div>
                </div>
        </form>

          
      </div>
    </section>

  </main><!-- End #main -->
  @endsection
