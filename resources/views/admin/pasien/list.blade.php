@extends('admin.layouts.app')
@extends('admin.layouts.footer')
@extends('admin.layouts.header')
@extends('admin.layouts.sidebar')
@section('title','List Data Pasien')
@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Pasien Page</h1>
      </div>
      <div class="section-body">
        <h2 class="section-title">List Data Pasien</h2>
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
                      <th>Umur</th>
                      <th>KTP</th>
                      <th>Jenis Kelamin</th>
                      <th>Handphone</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                    @foreach ($pasien as $key => $pas)
                    <tr>
                      <td>{{$pasien->firstItem()+$key}}</td>
                      <td>{{$pas->nama}}</td>
                      <td>{{$pas->umur}}</td>
                      <td>{{$pas->noktp}}</td>
                      <td>{{$pas->jenkel}}</td>
                      <td>{{$pas->nohp}}</td>
                      @if($pas->status == 'Aktif')
                        <td><div class="badge badge-success">{{$pas->status}}</div></td>
                      @else 
                        <td><div class="badge badge-warning">{{$pas->status}}</div></td> 
                      @endif
                      <td>
                        <a href="{{route('edit.pasien',$pas->id)}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i></a>
                        <a href="#" data-id="{{ $pas->id }}" class="btn btn-icon icon-left btn-danger alert-confirm"><i class="fas fa-times"></i>
                          <form action="{{route('delete.pasien', $pas->id)}}" id="delete{{ $pas->id }}" method="POST">
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
                    {{$pasien->links()}}
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