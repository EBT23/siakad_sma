@extends('layouts.base',['title' => "$title - Admin"])
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
                    <form action="{{ route('jadwal_pelajaran.post') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="id_guru" class="form-label">NIP - Guru</label>
                                <select class="form-select mb-3" name="id_guru" id="id_guru" aria-label="Default select example" required oninvalid="this.setCustomValidity('NIP - Guru tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <option value="" selected>-pilih-</option>
                                    @foreach ($guru as $g )
                                    <option value="{{ $g->id }}">{{ $g->username." - ".$g->nama }}</option>
                                    @endforeach
                                </select>
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-select mb-3" name="id_kelas" id="id_kelas" aria-label="Default select example" required oninvalid="this.setCustomValidity('Kelas tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <option value="" selected>-pilih-</option>
                                    @foreach ($kelas as $k )
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>

                                <label for="id_pelajaran" class="form-label">Pelajaran</label>
                                <select class="form-select mb-3" name="id_pelajaran" id="id_pelajaran" aria-label="Default select example" required oninvalid="this.setCustomValidity('Pelajaran tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <option value="" selected>-pilih-</option>
                                    @foreach ($pelajaran as $p )
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-6">
                                <label for="jam_mengajar" class="form-label">Jam Mengajar</label>
                                <div class="input-group mb-3">
                                    <input type="time" class="form-control" id="jam_mengajar" name="jam_mengajar" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Jam mengajar tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label for="jumlah_jam" class="form-label">Jumlah Jam</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="jumlah_jam" name="jumlah_jam" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Jumlah jam tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label for="hari" class="form-label">Hari</label>
                                <select class="form-select mb-3" name="hari" id="hari" aria-label="Default select example" required oninvalid="this.setCustomValidity('Pelajaran tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <option value="" selected>-pilih-</option>
                                    <option value="senin">senin</option>
                                    <option value="selasa">selasa</option>
                                    <option value="rabu">rabu</option>
                                    <option value="kamis">kamis</option>
                                    <option value="sabtu">sabtu</option>
                                    <option value="minggu">minggu</option>
                                </select>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-success text-white">Simpan</button>
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
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Pelajaran</th>
                                <th>Jam Mengajar</th>
                                <th>Jumlah Jam</th>
                                <th>Hari</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($jadwal_pelajaran as $index=>$jp)
                            <tr>
                                <td width="5%">{{ $index+1 }}</td>
                                <td>{{ $jp->id }}</td>
                                <td>{{ $jp->nama_kelas }}</td>
                                <td>{{ $jp->nama_pelajaran }}</td>
                                <td>{{ $jp->jam_mengajar }}</td>
                                <td>{{ $jp->jumlah_jam }}</td>
                                <td>{{ $jp->hari }}</td>
                                <td class="d-flex">
                                    <form action="hapusjadwalpelajaran/{{$jp->id }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt">Hapus</i>
                                        </button>
                                    </form>
                                    <span>
                                        <button type="button" class="btn btn-primary mx-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $jp->id }}">
                                            Edit
                                        </button>
                                    </span>
                                    <div class="modal fade" id="exampleModal{{ $jp->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit.jadwal_pelajaran',['id'=>$jp->id]) }}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="id_guru" class="form-label">NIP - Guru</label>
                                                                <select class="form-select" name="id_guru" id="id_guru" aria-label="Default select example">
                                                                    @foreach ($guru as $g )
                                                                    <option @if($g->id == $jp->id_guru) selected @endif value="{{ $g->id }}">{{ $g->nama }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="id_kelas" class="form-label">Kelas</label>
                                                                <select class="form-select" name="id_kelas" id="id_kelas" aria-label="Default select example">
                                                                    @foreach ($kelas as $k )
                                                                    <option @if($k->id == $jp->id_kelas) selected @endif value="{{ $g->id }}">{{ $k->nama }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="id_pelajaran" class="form-label">Pelajaran</label>
                                                                <select class="form-select" name="id_pelajaran" id="id_pelajaran" aria-label="Default select example">
                                                                    @foreach ($pelajaran as $p )
                                                                    <option @if($p->id == $jp->id_pelajaran) selected @endif value="{{ $p->id }}">{{ $p->nama }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <label for="jam_mengajar" class="form-label">Jam Mengajar</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="time" class="form-control" id="jam_mengajar" name="jam_mengajar" value="{{ $jp->jam_mengajar }}" aria-describedby="basic-addon3">
                                                                </div>

                                                                <label for="jumlah_jam" class="form-label">Jumlah Jam</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="number" class="form-control" id="jumlah_jam" name="jumlah_jam" value="{{ $jp->jumlah_jam }}" aria-describedby="basic-addon3">
                                                                </div>

                                                                <label for="hari" class="form-label">Hari</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-select mb-3" name="hari" id="hari" aria-label="Default select example" required oninvalid="this.setCustomValidity('Pelajaran tidak boleh kosong')" oninput="setCustomValidity('')">
                                                                        <option value="{{ $jp->hari }}" selected>{{ $jp->hari }}</option>
                                                                        <option value="senin">senin</option>
                                                                        <option value="selasa">selasa</option>
                                                                        <option value="rabu">rabu</option>
                                                                        <option value="kamis">kamis</option>
                                                                        <option value="sabtu">sabtu</option>
                                                                        <option value="minggu">minggu</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div>
                                                                <button type="submit" class="btn btn-success">Simpan</button>
                                                            </div>
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
