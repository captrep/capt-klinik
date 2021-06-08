@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Ubah Data Staff')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Staff Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">Edit Data Staff</h2>
        <p class="section-lead">Edit data dengan benar</p>
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Data Saat Ini</h4>
                      </div>
                      <div class="card-body">
                        <form action="{{route('update.staff', $user->id)}}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf 
                        <div class="form-group">
                          <label>Nama Lengkap Staff</label>
                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name') ?? $user->name}}">
                          @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Jabatan</label>
                          <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{old('jabatan') ?? $user->jabatan}}">
                          @error('jabatan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>E-mail</label>
                          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email') ?? $user->email}}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label>Username</label>
                          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username') ?? $user->username}}">
                            @error('username')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label>Foto</label>
                          <div class="form-group">
                            <img alt="image" src="{{asset('storage/' . $user->foto)}}" width="150" class="rounded-circle">
                          </div>
                          <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Ubah Data Staff</button>
                    </form>
                      </div>
                  </div>
      </div>
    </section>
  </div>
@endsection