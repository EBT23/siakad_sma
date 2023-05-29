
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
                    <option selected>{{ $k->nama }}</option>
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
        <td>{{ $si->$nama}}</td>
        <td>{{ $si->username}}</td>
        <td>{{ $si->$hp}}</td>
        <td>{{ $si->$alamat}}</td>
        <td><button type="submit">dsd</button></td>
      </tr>
      @endforeach
  </table>      
</div>
  
</div>
        
        </div>
      </div>

      
      <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2022 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
      </footer>
    </div>
