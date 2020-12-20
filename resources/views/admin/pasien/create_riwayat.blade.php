@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','Buat Riwayat Pasien')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pasien Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">Buat Riwayat Pasien</h2>
        <p class="section-lead">Isi data dengan benar</p>
        <div class="row">
                <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h4>Input Data</h4>
                      </div>
                      <div class="card-body">
                        
                        <form action="{{route('store.riwayat.pasien')}}" method="post">
                            @csrf 
                        <input type="hidden" name="pasien_id" value="{{request()->segment(count(request()->segments()))}}">
                        <div class="form-group">
                          <label>Diagnosis</label>
                          <textarea class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis">{{old('diagnosis')}}</textarea>
                          @error('diagnosis')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label>Obat</label>
                          <textarea class="form-control @error('obat') is-invalid @enderror" name="obat">{{old('obat')}}</textarea>
                          @error('obat')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                          @enderror
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Submit</button>
                    </form>
                    
                      </div>
                  </div>
      </div>
    </section>
  </div>
@endsection
