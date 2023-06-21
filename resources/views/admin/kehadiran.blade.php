
    @extends('layouts.base')
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
         
          <!-- /.row-->
              <h3>Form Tambah {{ $title }}</h3>
              <hr>
              <form action="{{ route('kehadiran.post') }}" method="post">
                @csrf
                <div class="my-2">
                  <button type="button" class="btn btn-success text-white" data-coreui-toggle="modal" data-coreui-target="#exampleModal">
                    Tambah Kehadiran +
                  </button>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <div class="row">
                          <div class="col-6">
                            <label for="id_siswa" class="form-label">Nama Siswa</label>
                            <select class="form-select" name="id_siswa" id="id_siswa" aria-label="Default select example">
                              <option selected>-pilih-</option>
                              @foreach ($siswa as $s )
                              <option value="{{ $s->id }}">{{ $s->nama }}</option>
                              @endforeach
                            </select>
                            @error('id_siswa')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <label for="id_pelajaran" class="form-label">Pelajaran</label>
                            <select class="form-select" name="id_pelajaran" id="id_pelajaran" aria-label="Default select example" required oninvalid="this.setCustomValidity('Pelajaran tidak boleh kosong')" oninput="setCustomValidity('')">
                              <option value="" selected>-pilih-</option>
                              @foreach ($pelajaran as $p )
                              <option value="{{ $p->id }}">{{ $p->nama }}</option>
                              @endforeach
                            </select>
                            @error('id_pelajaran')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="col-6">
                            <label for="tanggal" class="form-label">Tanggal</label>
                          <div class="input-group mb-3">
                            <input type="date" class="form-control" id="tanggal" name="tanggal" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                          </div>
                            <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                            <select class="form-select" name="status_kehadiran" id="status_kehadiran" aria-label="Default select example" required oninvalid="this.setCustomValidity('Status Kehadiran tidak boleh kosong')" oninput="setCustomValidity('')">
                              <option value="" selected>-pilih-</option>
                              <option value="Hadir">Hadir</option>
                              <option value="Alpa">Alpa</option>
                              <option value="Sakit">Sakit</option>
                              <option value="Izin">Izin</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
          
<div class="card mb-4">
<div class="card-body">
  <table id="dataTabel" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th width="5%">No</th>
        <th>Nama</th>
        <th>Nama Pelajaran</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th width="10%">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($kehadiran as $index=> $k )
      <tr>
        <td>{{ $index +1 }}</td>
        <td>{{ $k->nama }}</td>
        <td>{{ $k->nama_pelajaran }}</td>
        <td>{{ $k->tanggal }}</td>
        <td>{{ $k->status_kehadiran }}</td>
        <td class="d-flex">
          <span>
            <form action="hapuskehadiran/{{$k->id }}" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger m-md-2" type="submit"><i class="fas fa-trash-alt">Hapus</i></button>
          </form>
          </span>
          <span>
            <button type="button" class="btn btn-primary mt-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $k->id }}">
              Edit
            </button>
          </span>
        <div class="modal fade" id="exampleModal{{ $k->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="{{ route('edit.kehadiran',['id'=>$k->id]) }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="col-12">
                      <label for="id_siswa" class="form-label">Pelajaran</label>
                      <select class="form-select" name="id_siswa" id="id_siswa" aria-label="Default select example" required>
                        @foreach ($siswa as $s )
                        <option @if($s->id == $k->id_siswa) selected @endif value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-12">
                      <label for="id_pelajaran" class="form-label">Pelajaran</label>
                      <select class="form-select" name="id_pelajaran" id="id_pelajaran" aria-label="Default select example">
                        @foreach ($pelajaran as $p )
                        <option @if($p->id == $k->id_pelajaran) selected @endif value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-12">
                      <label for="tanggal" class="form-label">Tanggal </label>
                      <input type="date" class="form-control" id="tanggal" name="tanggal"  placeholder="ffsufhseid" value="{{ $k->tanggal }}">
                    </div>
                    <div class="col-12">
                      <label for="status_kehadiran" class="form-label">Status Kehadiran </label>
                      <select class="form-select" name="status_kehadiran" id="status_kehadiran" aria-label="Default select example">
                        <option value="{{ $k->status_kehadiran }}">{{ $k->status_kehadiran }}</option>
                        <option value="Hadir">Hadir</option>
                        <option value="Alpa">Alpa</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Izin">Izin</option>
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
        </td>
      </tr>
      @endforeach
  </table>      
</div>
  
</div>
        
        </div>
      </div>

      
     @include('layouts.footer')
    </div>
