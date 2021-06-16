@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','List Data Testimonial')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Testimonial Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">List Data Testimonial</h2>
        <p class="section-lead">
          This page is just an example for you to create your own page.</p>
        <div class="row">
          <div class="col-2">

          </div>
          <div class="col-8">
              <div class="card">
                <div class="card-header">
                  <h4>Simple Table</h4>
                </div>
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-striped table-md">
                    <tr>
                      <th>#</th>
                      <th>Nama</th>
                      <th>Isi Testimonial</th>
                      <th>Action</th>
                    </tr>
                    @foreach ($testimonial as $key => $testi)
                    <tr>
                      <td>{{$testimonial->firstItem()+$key}}</td>
                      <td>{{$testi->pasien->nama}}</td>
                      <td>{{$testi->testi}}</td>
                      <td>
                        <a href="#" data-id="{{ $testi->id }}" class="btn btn-icon icon-left btn-danger alert-confirm">Delete Testimonial
                          <form action="{{route('delete.testimonial', $testi->id)}}" id="delete{{ $testi->id }}" method="POST">
                            @csrf
                            @method('delete')
                          </form>
                        </a>
                      </td>
                    </tr>
                    @endforeach
                    
                  </table>
                </div>
              </div>
              <div class="card-footer text-right">
                <nav class="d-inline-block">
                  <ul class="pagination mb-0">
                    {{$testimonial->links()}}
                  </ul>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </section>
</div>
@endsection

@push('spesific-js')
<script src="{{ asset('admin') }}/assets/js/page/modules-sweetalert.js"></script>
@endpush

@push('after-script')
  <script>
    $(".alert-confirm").click(function(e) {
      id = e.target.dataset.id;
  swal({
      title: 'Yakin mo diapus?',
      text: 'Kalo dah diapus, ya dianya bakal ilang dan gabakal balik lagi',
      icon: 'warning',
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
      $(`#delete${id}`).submit();
      } else {
      swal('Oke sidata gajadi ilang!');
      }
    });
});
    </script>
@endpush