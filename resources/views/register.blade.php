@extends('layouts.app')
@extends('layouts.header')
@extends('layouts.footer')
@section('title','Register')
@section('content')
  <main id="main">

    <!-- ======= Breadcrumbs Section ======= -->
    <section class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Register Page</h2>
          <ol>
            <li><a href="{{route('welcome')}}">Home</a></li>
            <li>Register Page</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs Section -->

    <section class="appointment inner-page" id="appointment">
      <div class="container">
          @if (session()->has('success'))
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Pendaftaran berhasil dilakukan!</h4>
            <p>Silahkan melakukan pembayaran pendaftaran sebesar Rp. 5.000 melalui staff administrasi agar status pasien menjadi aktif dan dapat membuat antrian</p>
          </div>
          @endif

        <div class="section-title">
            <h2>Pendaftaran Pasien</h2>
          <p>Isilah data data dibawah ini sesuai dengan identitas / data diri pasien</a></p>
          </div>
    
          <form action="{{route('storelanding.pasien')}}"  method="post">
              @csrf
                <div class="form-row">
                    <div class="col-md-4 form-group">
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{old('nama')}}" placeholder="Isi dengan nama pasien">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control @error('umur') is-invalid @enderror" name="umur" id="umur" value="{{old('umur')}}" placeholder="Isi dengan umur pasien">
                        @error('umur')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                    @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control @error('noktp') is-invalid @enderror" name="noktp" id="noktp" value="{{old('noktp')}}" placeholder="Isi dengan nomor ktp pasien">
                        @error('noktp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 form-group">
                        <select name="jenkel" id="jenkel" class="form-control @error('jenkel') is-invalid @enderror">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                        </select>
                        @error('jenkel')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="tel" class="form-control @error('nohp') is-invalid @enderror" name="nohp" id="nohp" value="{{old('nohp')}}" placeholder="Isi dengan nomor handphone pasien">
                        @error('noktp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>
        
                <div class="form-group">
                    <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" rows="5" placeholder="Alamat">{{old('alamat')}}</textarea>
                    @error('alamat')
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
