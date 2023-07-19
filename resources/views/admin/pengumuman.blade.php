@extends('layouts.base')
@include('layouts.sidebar')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include('layouts.header')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">

            <!-- /.row-->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Form Tambah {{ $title }}</h5>
                    <hr>
                    <form action="{{ route('pengumuman.post') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" id="tanggal" name="tanggal" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('tanggal tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label for="judul" class="form-label">Judul </label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="judul" name="judul" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('judul tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>

                            </div>
                            <div class="col-6">
                                <label for="isi_pengumuman" class="form-label">Isi Pengumuman </label>
                                <div class="input-group mb-3">
                                    <textarea name="isi_pengumuman" class="form-control" id="isi_pengumuman" cols="10" rows="5" required oninvalid="this.setCustomValidity('Isi pengumuman tidak boleh kosong')" oninput="setCustomValidity('')"></textarea>
                                </div>

                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">Simpan</button>
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
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Isi Pengumuman</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengumuman as $index => $p )
                            <tr>
                                <td>{{ $index +1 }}</td>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->judul }}</td>
                                <td>{{ $p->isi_pengumuman }}</td>
                                <td class="d-flex">
                                    <span>
                                        <form action="hapuspengumuman/{{$p->id }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger m-md-2" type="submit" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')"><i class="fas fa-trash-alt">Hapus</i></button>
                                        </form>
                                    </span>
                                    <span>
                                        <button type="button" class="btn btn-primary mt-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $p->id }}">
                                            Edit
                                        </button>
                                    </span>
                                    <div class="modal fade" id="exampleModal{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Pelajaran</h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit.pengumuman',['id'=>$p->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $p->tanggal }}" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="judul" class="form-label">Judul</label>
                                                                <input type="text" class="form-control" id="judul" name="judul" value="{{ $p->judul }}" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="isi_pengumuman" class="form-label">Isi Pengumuman</label>
                                                                <div class="input-group mb-3">
                                                                    <textarea name="isi_pengumuman" class="form-control" id="isi_pengumuman" cols="10" rows="5" required required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">{{ $p->isi_pengumuman }}</textarea>
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
                    </table>
                </div>

            </div>

        </div>
    </div>


    @include('layouts.footer')
</div>
