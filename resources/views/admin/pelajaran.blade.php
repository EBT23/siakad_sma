
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
                    <OPtion value="KELOMPOK A (UMUM)">KELOMPOK A (UMUM)</OPtion>
                    <option value="KELOMPOK B (UMUM)">KELOMPOK B (UMUM)</option>
                    <option value="KELOMPOK C (PEMINATAN MIPA)">KELOMPOK C (PEMINATAN MIPA)</option>
                    <option value="KELOMPOK C (PEMINATAN IIS)">KELOMPOK C (PEMINATAN IIS)</option>
                    <option value="LINTAS MINAT">LINTAS MINAT</option>
                    
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
        <td class="d-flex">
          <span>
            <form action="hapuspelajaran/{{$pl->id }}" method="POST">
              @method('DELETE')
              @csrf
              <button class="btn btn-danger m-md-2" type="submit"><i class="fas fa-trash-alt">Hapus</i></button>
          </form>
            </span>   
            <span>
              <button type="button" class="btn btn-primary mt-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $pl->id }}">
                Edit
              </button>
              </span> 
          <div class="modal fade" id="exampleModal{{ $pl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Pelajaran</h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('edit.pelajaran',['id'=>$pl->id]) }}" method="POST">
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

                      <div class="col-12">
                        <label for="kode" class="form-label">Kode Pelajaran</label>
                        <label for="kelompok" class="form-label">-kelompok pelajaran-</label>
                            <select class="form-select" name="kelompok" id="kelompok" aria-label="Default select example">
                             <option value="{{ $pl->kelompok }}">{{ $pl->kelompok }}</option>
                             <OPtion value="KELOMPOK A (UMUM)">KELOMPOK A (UMUM)</OPtion>
                             <option value="KELOMPOK B (UMUM)">KELOMPOK B (UMUM)</option>
                             <option value="KELOMPOK C (PEMINATAN MIPA)">KELOMPOK C (PEMINATAN MIPA)</option>
                             <option value="KELOMPOK C (PEMINATAN IIS)">KELOMPOK C (PEMINATAN IIS)</option>
                             <option value="LINTAS MINAT">LINTAS MINAT</option>
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
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>      
</div>

</div>
    </div>
      </div>
     @include('layouts.footer')
    </div>
