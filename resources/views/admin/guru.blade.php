@extends('layouts.base')
@include('layouts.sidebar')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include('layouts.header')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">

            <!-- /.row-->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Form Tambah Data Guru</h5>
                    <hr>
                    <form action="{{ route('gurupost') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="nip" class="form-label">NIP</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" id="nip" name="nip" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('NIP tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                @if ($errors->has('nip'))
                                <p>{{ $errors->first('nip') }}</p>
                                @endif
                                <label for="nama" class="form-label">Nama Guru</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Guru tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="tempat" class="form-label">Tempat Lahir</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="tempat" name="tempat" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Siswa tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="tgl_lahir" class="form-label ">Tanggal Lahir</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Tanggal lahir tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label for="password" class="form-label">Password Akun</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Password Akun tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                            </div>

                            <div class="col-6">
                                <label for="pendidikan" class="form-label">Pendidikan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Pendidikan tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="tmk" class="form-label">TMK</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" id="tmk" name="tmk" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('TMK tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="jabatan" name="jabatan" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Jabatan tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="alamat" name="alamat" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Alamat tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>

                                <label for="tgs_tam" class="form-label">Tugas Tambahan</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="tgs_tam" name="tgs_tam" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Tugas tambahan tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <div class="form-group">
                                    <label for="kelas" class="form-label">Wali Kelas Di</label>
                                    <select class="form-control" id="kelas" name="kelas" required>
                                        <option value="">Pilih Kelas</option>
                                        <option value="0">Bukan Wali Kelas</option>
                                        @foreach ( $kelas as $k )
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>

                      </form>
                </div>
            </div>

        </div>
        <div class="card mb-4">
            @if(session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>
            @endif
            <div class="card-body">
                <table id="dataTabel" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>TTL</th>
                            <th>Pendidikan</th>
                            <th>TMK</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>Tgs Tambahan</th>
                            <th>Wali Kelas Di</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($guru as $index => $g )
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $g->username }}</td>
                            <td>{{ $g->nama }}</td>
                            <td>{{ $g->tempat.", ".$g->tgl_lahir }}</td>
                            <td>{{ $g->pendidikan }}</td>
                            <td>{{ $g->tmk }}</td>
                            <td>{{ $g->jabatan }}</td>
                            <td>{{ $g->alamat }}</td>
                            <td>{{ $g->tgs_tam }}</td>
                            <td>{{ $g->nama_kelas }}</td>
                            <td class="d-flex">
                                <form action="hapusguru/{{$g->id }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger " type="submit" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')"><i class="fas fa-trash-alt">Hapus</i></button>
                                </form>
                                <span>
                                    <button type="button" class="btn btn-primary mx-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $g->id }}">
                                        Edit
                                    </button>
                                </span>
                                <div class="modal fade" id="exampleModal{{ $g->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit Guru</h5>
                                                <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('edit.guru',['id'=>$g->id]) }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="nip" class="form-label">NIP</label>
                                                            <div class="input-group mb-3">
                                                                <input type="number" class="form-control" id="nip" name="nip" value="{{ $g->username }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <label for="nama" class="form-label">Nama Guru</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $g->nama }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <label for="tempat" class="form-label">Tempat Lahir</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id="tempat" name="tempat" value="{{ $g->tempat }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <label for="tgl_lahir" class="form-label ">Tanggal Lahir</label>
                                                            <div class="input-group mb-3">
                                                                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{ $g->tgl_lahir }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>

                                                        </div>
                                                        <div class="col-6">
                                                            <label for="pendidikan" class="form-label">Pendidikan</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ $g->pendidikan }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <label for="tmk" class="form-label">TMK</label>
                                                            <div class="input-group mb-3">
                                                                <input type="date" class="form-control" id="tmk" name="tmk" value="{{ $g->tmk }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <label for="jabatan" class="form-label">Jabatan</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ $g->jabatan }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>

                                                            <label for="alamat" class="form-label">Alamat</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $g->alamat }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>

                                                            <label for="tgs_tam" class="form-label">Tugas Tambahan</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" id="tgs_tam" name="tgs_tam" value="{{ $g->tgs_tam }}" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kelas" class="form-label">Wali Kelas Di</label>
                                                                <select class="form-control" id="kelas" name="kelas" required>
                                                                    <option value="">Pilih Kelas</option>
                                                                    <option value="0">Bukan Wali Kelas</option>
                                                                    @foreach ( $kelas as $k )
                                                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                                                    @endforeach
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
@include('layouts.footer')
</div>
