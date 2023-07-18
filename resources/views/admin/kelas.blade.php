
    @extends('layouts.base')
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
         
          <!-- /.row-->
          <div class="card mb-4">
            <div class="card-body">
              <h5>Form {{ $title }}</h5>
              <hr>
              <form action="{{ route('kelas.post') }}" method="post">
              @csrf
              <div class="row">
                <div class="col-6">
                  <label for="kelas" class="form-label">Nama Kelas</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="kelas" name="kelas" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Nama kelas tidak boleh kosong')" oninput="setCustomValidity('')">
                  </div>
                  @if ($errors->has('kelas'))
                  <p >{{ $errors->first('kelas') }}</p>
                  @endif
                  <div class="my-3">
                    <button type="submit" class="btn btn-success" >Simpan</button>
                  </div>
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
        <th width="5%" >No</th>
        <th>Nama Kelas</th>
        <th width="15%">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($kelas as $index=>$kl )
        
      <tr>
        <td>{{ $index+1 }}</td>
        <td>{{ $kl->nama }}</td>
        <td class="d-flex">    
          <span>
            <form action="hapuskelas/{{$kl->id }}" method="POST">
              @method('DELETE')
              @csrf
              <button class="btn btn-danger m-md-2" type="submit" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')"><i class="fas fa-trash-alt">Hapus</i></button>
            </form>
          </span>
          <span>
            <button type="button" class="btn btn-primary mt-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $kl->id }}">
              Edit
            </button>
          </span>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>      
</div>
<!-- Modal -->
@foreach ($kelas as $kl )
<div class="modal fade" id="exampleModal{{ $kl->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('edit.kelas',['id'=>$kl->id]) }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <label for="kelas" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="kelas" name="kelas"  placeholder="ffsufhseid" value="{{ $kl->nama }}">
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

  
