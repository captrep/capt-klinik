@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Ubah Data Staff')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pasien Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">Edit Data Pasien</h2>
        <p class="section-lead">Edit data dengan benar</p>
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Data Saat Ini</h4>
                      </div>
                      <div class="card-body">
                        <form action="{{route('update.pasien', $pasien->id)}}" method="post">
                            @method('patch')
                            @csrf 
                            <div class="form-group">
                              <label>Nama Lengkap Pasien</label>
                              <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{old('nama') ?? $pasien->nama}}">
                              @error('nama')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label>Umur Pasien</label>
                              <input type="text" name="umur" class="form-control @error('umur') is-invalid @enderror" value="{{old('umur') ?? $pasien->umur}}">
                              @error('umur')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label>Nomor KTP/Identitas</label>
                              <input type="text" name="noktp" class="form-control @error('noktp') is-invalid @enderror" value="{{old('noktp') ?? $pasien->noktp}}">
                              @error('noktp')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                              @enderror
                            </div>
                            <div class="form-group">
                              <label>Jenis Kelamin</label>
                                <select class="form-control select2 @error('jenkel') is-invalid @enderror" name="jenkel">
                                  <option value="Laki-laki" {{ ($pasien->jenkel) == 'Laki-laki' ? 'selected' : '' }} >Laki-laki</option>
                                  <option value="Perempuan" {{ ($pasien->jenkel) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenkel')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                 @enderror
                            </div>
                            <div class="form-group">
                              <label>Alamat</label>
                              <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{old('alamat') ?? $pasien->alamat}}">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label>Handphone</label>
                              <input type="text" name="nohp" class="form-control @error('nohp') is-invalid @enderror" value="{{old('nohp') ?? $pasien->nohp}}">
                                @error('nohp')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                              <label>Status</label>
                                <select class="form-control select2 @error('status') is-invalid @enderror" name="status">
                                  <option value="Aktif" {{ ($pasien->status) == 'Aktif' ? 'selected' : '' }} >Aktif</option>
                                  <option value="Belum Aktif" {{ ($pasien->status) == 'Belum Aktif' ? 'selected' : '' }}>Belum Aktif</option>
                                </select>
                                @error('status')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                 @enderror
                            </div>
                        <button type="submit" class="btn btn-block btn-primary">Ubah Data Pasien</button>
                    </form>
                      </div>
                  </div>
      </div>
    </section>
  </div>
@endsection