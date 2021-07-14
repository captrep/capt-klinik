@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')
@section('title','Konfirmasi Bayar')
@section('content')
  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Konfirmasi Pembayaran Page</h2>
          <ol>
            <li><a href="{{route('welcome')}}">Home</a></li>
            <li>Konfirmasi Pembayaran Page</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="appointment inner-page" id="appointment">
      <div class="container">
          @if (session()->has('success'))
          <div class="alert alert-success" role="alert">
            <div class="text-center">
                <h4 class="alert-heading">BERHASIL!</h4>
                <hr>
                <p>Terimakasih permintaan anda akan segera dikonfirmasi</p>
            </div>
          </div>
          @elseif (session()->has('duplicate'))
          <div class="alert alert-warning" role="alert">
            <div class="text-center">
                <h4 class="alert-heading">GAGAL!</h4>
                <hr>
                <p>Anda telah mengirimkan permintaan sebelumnya, silahkan tunggu konfirmasi</p>
            </div>
          </div>
          @elseif (session()->has('notregist'))
          <div class="alert alert-danger" role="alert">
            <div class="text-center">
                <h4 class="alert-heading">GAGAL!</h4>
                <hr>
                <p>Pasien ini belum terdaftar dalam sistem kami</p>
            </div>
          </div>
          @elseif (session()->has('confirmed'))
          <div class="alert alert-danger" role="alert">
            <div class="text-center">
                <h4 class="alert-heading">GAGAL!</h4>
                <hr>
                <p>Status pasien ini telah aktif!</p>
            </div>
          </div>
          @endif

        <div class="section-title">
            <h2>Konfirmasi Pembayaran Page</h2>
          <p>Hanya bisa diisi oleh pasien yang telah belum terkonfirmasi di CaptKlinik dan hanya bisa diisi 1 kali oleh setiap pasien</p>
          </div>
    
          <form action="{{route('store.konfirmasiBayar')}}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="form-row">
                    <div class="col-md-12 form-group">
                    <input type="text" name="noktp" class="form-control @error('noktp') is-invalid @enderror" id="noktp" value="{{old('noktp')}}" placeholder="Isi dengan noktp pasien">
                        @error('noktp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-group">
                  <div class="custom-file">
                    <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile">Upload bukti transfer disini ..</label>
                    @error('foto')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>

          
      </div>
    </section>

  </main><!-- End #main -->
  @endsection
