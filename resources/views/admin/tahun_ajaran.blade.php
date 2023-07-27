
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
              <form action="{{ route('tahun_ajaran.post') }}" method="post">
              @csrf
              <div class="row">
                
                <div class="col-6">
                  <label for="nama" class="form-label">tahun Ajaran</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="thn_ajaran" name="thn_ajaran" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data nama pelajaran tidak boleh kosong')" oninput="setCustomValidity('')">
                  </div>
                  @if ($errors->has('thn_ajaran'))
                  <p >{{ $errors->first('thn_ajaran') }}</p>
                  @endif
                 
                  <label for="id_kelompok" class="form-label">Status</label>
                  <select class="form-select" name="is_active" id="is_active" aria-label="Default select example" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                    <option value="" selected>-pilih-</option>
                    <option value="1">Active</option>
                    <option value="0">Non Active</option>
                  </select>
                  @if ($errors->has('is_active'))
                  <p >{{ $errors->first('is_active') }}</p>
                  @endif
                <div class="my-3">
                  <button type="submit" class="btn btn-success" >Simpan</button>
                </div>
              </div>
            </form>
              
             
            </div>
          
          </div>
<div class="card mb-4">
  @if(session('success'))
  <div class="alert alert-success d-flex align-items-center" role="alert">
      <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
          <use xlink:href="#check-circle-fill" /></svg>
      <div>
          {{ session('success') }}
      </div>
  </div>
  @endif
<div class="card-body">
  <table id="dataTabel" class="table table-striped" style="width:100%">
    <thead>
     
      <tr>
        <th width="5%">No</th>
        <th>Tahun Ajaran</th>
        <th>Status</th>
        <th width="10%">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($thn_ajaran as $index=>$th )
      <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $th->name_thn_ajaran }}</td>
        <td>@if ($th->is_active ==1)
            Active
        @else
            Non Active
        @endif</td>
        <td class="d-flex">
          <span>
            <form action="hapustahun_ajaran/{{$th->id }}" method="POST">
              @method('DELETE')
              @csrf
              <button class="btn btn-danger m-md-2" type="submit" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')"><i class="fas fa-trash-alt">Hapus</i></button>
          </form>
            </span>   
            <span>
              <button type="button" class="btn btn-primary mt-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $th->id }}">
                Edit
              </button>
              </span> 
          <div class="modal fade" id="exampleModal{{ $th->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Edit Pelajaran</h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="{{ route('edit.tahun_ajaran',['id'=>$th->id]) }}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-12">
                        <label for="nama" class="form-label">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="thn_ajaran" name="thn_ajaran" value="{{ $th->name_thn_ajaran }}" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                      </div>
                      <div class="col-12">
                        <label for="kode" class="form-label">Status</label>
                        <label for="kelompok" class="form-label">-kelompok pelajaran-</label>
                            <select class="form-select" name="is_active" id="is_active" aria-label="Default select example" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                             <option value="{{ $th->is_active }}" selected>{{ $th->is_active }}</option>
                             <option value="0">Active</option>
                             <option value="1">Non Active</option>
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
