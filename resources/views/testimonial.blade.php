@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')
@section('title','Isi Testimonial')
@section('content')
  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Isi Testmonial Page</h2>
          <ol>
            <li><a href="{{route('welcome')}}">Home</a></li>
            <li>Isi Testimonial Page</li>
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
                <p>Terimakasih telah mengisi testimonial</p>
            </div>
          </div>
          @elseif (session()->has('duplicate'))
          <div class="alert alert-warning" role="alert">
            <div class="text-center">
                <h4 class="alert-heading">GAGAL!</h4>
                <hr>
                <p>Pasien ini telah mengisi testimonial sebelumnya</p>
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
          @endif

        <div class="section-title">
            <h2>Isi Testimonial</h2>
          <p>Hanya bisa diisi oleh pasien yang telah terdaftar di CaptKlinik dan hanya bisa diisi 1 kali oleh setiap pasien</p>
          </div>
    
          <form action="{{route('store.testimonial')}}"  method="post">
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
                    <textarea class="form-control @error('testi') is-invalid @enderror" name="testi" rows="5" placeholder="Isi dengan testimonial anda">{{old('testi')}}</textarea>
                    @error('testi')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
          </form>

          
      </div>
    </section>

  </main><!-- End #main -->
  @endsection
