@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Tambah Data Dokter')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Dokter Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">Tambah Data Dokter</h2>
        <p class="section-lead">Isi data dengan benar</p>
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Input Data</h4>
                      </div>
                      <div class="card-body">
                        <form action="{{route('store.dokter')}}" method="post" enctype="multipart/form-data">
                            @csrf 
                        <div class="form-group">
                          <label>Nama Lengkap Dokter</label>
                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}">
                          @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Jabatan</label>
                          <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{old('jabatan')}}">
                          @error('jabatan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>E-mail</label>
                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label>Password</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <div class="input-group-text">
                                <i class="fas fa-lock"></i>
                              </div>
                            </div>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" data-indicator="pwindicator">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Foto</label>
                          <div class="custom-file">
                            <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @error('foto')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                          </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Tambah Data Submit</button>
                    </form>
                      </div>
                  </div>
      </div>
    </section>
  </div>
@endsection