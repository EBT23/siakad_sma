
    @extends('layouts.base')
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
         
          <!-- /.row-->
          <div class="card mb-4">
            <div class="card-body">
              <h5>Form Tambah Data Pelajaran</h5>
              <hr>
              <form action="{{ route('pelajaran.post') }}" method="post">
              @csrf
              <div class="row">
                
                <div class="col-6">
                  <label for="nama" class="form-label">Nama Pelajaran</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="basic-addon3">
                  </div>
                  <label for="kode" class="form-label">Kode Pelajaran</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="kode" name="kode" aria-describedby="basic-addon3">
                  </div>
                </div>
                <div class="col-6">
                  <label for="id_kelompok" class="form-label">-kelompok pelajaran-</label>
                  <select class="form-select" name="id_kelompok" id="id_kelompok" aria-label="Default select example">
                    <option selected>-pilih-</option>
                    @foreach ($kelompok as $kl )
                    <option value="{{ $kl->id }}">{{ $kl->kelompok }}</option>
                    @endforeach
                    
                  </select>
                </div>
                <div class="my-3">
                  <button type="submit" class="btn btn-success" >Simpan</button>
                </div>
              </div>
            </form>
              
             
            </div>
          
          </div>
<div class="card mb-4">
<div class="card-body">
  <table id="dataTabel" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th>Pelajaran</th>
        <th>Jenis Kelompok</th>
        <th>Kode PElajaran</th>
        <th width="10%">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pelajaran as $index=>$pl )
      <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $pl->nama }}</td>
        <td>{{ $pl->kelompok }}</td>
        <td>{{ $pl->kode }}</td>
        <td class="">    
          <form action="hapuspelajaran/{{$pl->id }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt">Hapus</i></button>
        </form>
          <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $pl->kp }}">
            Edit
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>      
</div>
@foreach ($pelajaran as $pl )
<div class="modal fade" id="exampleModal{{ $pl->kp }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Pelajaran</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('edit.pelajaran',['id'=>$pl->kp]) }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <label for="nama" class="form-label">Nama Pelajaran</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{ $pl->nama }}">
            </div>
            <div class="col-12">
              <label for="kode" class="form-label">Kode Pelajaran</label>
              <input type="text" class="form-control" id="kode" name="kode" value="{{ $pl->kode }}">
            </div>
            <label for="id_kelompok" class="form-label">-kelompok pelajaran-</label>
                  <select class="form-select" name="id_kelompok" id="id_kelompok" aria-label="Default select example">
                    @foreach ($kelompok as $kl )
                    <option @if($kl->id == $pl->id_kelompok) selected @endif value="{{ $kl->id }}">{{ $kl->kelompok }}</option>
                    @endforeach
                    
                  </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach
</div>
    </div>
      </div>
     @include('layouts.footer')
    </div>
