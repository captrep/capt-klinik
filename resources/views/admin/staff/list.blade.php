@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','List Data ')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Staff Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">List Data staff</h2>
        <p class="section-lead">
          This page is just an example for you to create your own page.</p>
        <div class="row">
          <div class="col-12">
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
                      <th>Username</th>
                      <th>Email</th>
                      <th>Jabatan</th>
                      <th>Foto</th>
                      <th>Action</th>
                    </tr>
                    @foreach ($staff as $key => $stf)
                    <tr>
                      <td>{{$staff->firstItem()+$key}}</td>
                      <td>{{$stf->name}}</td>
                      <td>{{$stf->username}}</td>
                      <td>{{$stf->email}}</td>
                      <td>{{$stf->jabatan}}</td>
                      <td>
                        <img alt="image" src="{{asset('storage/' . $stf->foto)}}" class="rounded-circle" width="35">
                      </td>
                      <td>
                        <a href="{{route('edit.staff',$stf->id)}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i></a>
                        <a href="#" data-id="{{ $stf->id }}" class="btn btn-icon icon-left btn-danger alert-confirm"><i class="fas fa-times"></i>
                          <form action="{{route('delete.staff', $stf->id)}}" id="delete{{ $stf->id }}" method="POST">
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
                    {{$staff->links()}}
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