@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Tambah Data Pasien')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pasien Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">Tambah Data Pasien</h2>
        <p class="section-lead">Isi data dengan benar</p>
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Input Data</h4>
                      </div>
                      <div class="card-body">
                        <form action="{{route('store.pasien')}}" method="post">
                            @csrf 
                        <div class="form-group">
                          <label>Nama Lengkap Pasien</label>
                          <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama')}}">
                          @error('nama')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Umur Pasien</label>
                          <input type="text" name="umur" class="form-control @error('umur') is-invalid @enderror" value="{{old('umur')}}">
                          @error('umur')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Nomor KTP/Identitas</label>
                          <input type="text" name="noktp" class="form-control @error('noktp') is-invalid @enderror" value="{{old('noktp')}}">
                          @error('noktp')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Jenis Kelamin</label>
                            <select class="form-control select2 @error('jenkel') is-invalid @enderror" name="jenkel">
                              <option value="">--Pilih Jenis Kelamin--</option>
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                          @error('jenkel')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                           @enderror
                        </div>
                        <div class="form-group">
                          <label>Alamat</label>
                          <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat')}}">
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label>Handphone</label>
                          <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror" value="{{old('nohp')}}">
                            @error('nohp')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                            <select class="form-control select2 @error('status') is-invalid @enderror" name="status">
                              <option value="">--Pilih Status--</option>
                              <option value="Aktif">Aktif</option>
                              <option value="Belum Aktif">Belum Aktif</option>
                            </select>
                          @error('status')
                          <div class="invalid-feedback">
                              {{$message}}
                          </div>
                           @enderror
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Tambah Data Submit</button>
                    </form>
                    
                      </div>
                  </div>
      </div>
    </section>
  </div>
@endsection
