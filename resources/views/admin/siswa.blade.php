
    @extends('layouts.base')
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
         
          <!-- /.row-->
          <div class="card mb-4">
            <div class="card-body">
              <h5>Form Tambah Data Siswa</h5>
              <hr>
              <form action="{{ route('siswa.post') }}" method="post">
              @csrf
              <div class="row">
                <div class="col-6">
                  <label for="nis" class="form-label">NIS</label>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" id="nis" name="nis" aria-describedby="basic-addon3">
                  </div>
                  <label for="nama" class="form-label">Nama Siswa</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="basic-addon3">
                  </div>
                  <label for="hp" class="form-label">No HP</label>
                  <div class="input-group mb-3">
                    <input type="number" class="form-control" id="hp" name="hp" aria-describedby="basic-addon3">
                  </div>
                </div>
                <div class="col-6">
                  <label for="alamat" class="form-label">Alamat</label>
                  <div class="input-group mb-3">
                    <input type="alamat" class="form-control" id="alamat" name="alamat" aria-describedby="basic-addon3">
                  </div>
                  <label for="password" class="form-label">Password Akun</label>
                  <div class="input-group mb-3">
                    <input type="password" class="form-control" id="password" name="password" aria-describedby="basic-addon3">
                  </div>
                  <label for="id_kelas" class="form-label">Kelas</label>
                  <select class="form-select" name="id_kelas" id="id_kelas" aria-label="Default select example">
                    <option selected>-pilih-</option>
                    @foreach ($kelas as $k )
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                    @endforeach
                  </select>
                </div>
                <div>
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
        <th>NO</th>
        <th>NIS</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>No HandPhone</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($siswa as $index=>$si )
      <tr>
        <td>{{ $index+1}}</td>
        <td>{{ $si->username}}</td>
        <td>{{ $si->nama}}</td>
        <td>{{ $si->hp}}</td>
        <td>{{ $si->alamat}}</td>
        <td>{{ $si->nama_kelas}}</td>
        <td>
          <button type="button" class="btn btn-primary" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $si->id }}">
            Edit
          </button>
          <button class="btn btn-danger" type="submit">Delete</button>
        </td>
      </tr>
      @endforeach
  </table>      
</div>
@foreach ($siswa as $s )
  
<div class="modal fade" id="exampleModal{{ $si->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('edit.siswa',['id'=>$s->id]) }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <label for="nama" class="form-label">Nama Pelajaran</label>
              <input type="text" class="form-control" id="nama" name="nama" value="{{ $s->nama }}">
            </div>
            <div class="col-12">
              <label for="hp" class="form-label">NIP</label>
              <input type="text" class="form-control" id="hp" name="hp" value="{{ $s->username }}">
            </div>
            <div class="col-12">
              <label for="hp" class="form-label">Nomor Hp</label>
              <input type="text" class="form-control" id="hp" name="hp" value="{{ $s->hp }}">
            </div>
            <div class="col-12">
              <label for="id_kelompok" class="form-label">-kelompok pelajaran-</label>
              <select class="form-select" name="id_kelompok" id="id_kelompok" aria-label="Default select example">
                @foreach ($kelas as $k )
                <option @if($k->id == $si->id_kelas) selected @endif value="{{ $k->id }}">{{ $k->nama }}</option>
                @endforeach
              </select>
            </div>
        
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
