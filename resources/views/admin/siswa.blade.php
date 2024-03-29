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


                    <form action="{{ route('siswa.post') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <label for="nis" class="form-label">NIS</label>
                                <div class="input-group mb-1">
                                    <input type="number" class="form-control " id="nis" name="nis" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('NIS tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                @if ($errors->has('nis'))
                                <p>{{ $errors->first('nis') }}</p>
                                @endif
                                <label for="nama" class="form-label">Nama Siswa</label>
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="nama" name="nama" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('Nama siswa tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="hp" class="form-label">No HP</label>
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" id="hp" name="hp" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('No hp tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="alamat" class="form-label">Alamat</label>
                                <div class="input-group mb-3">
                                    <input type="alamat" class="form-control" id="alamat" name="alamat" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('alamat tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="password" class="form-label">Password Akun</label>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="basic-addon3" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')">
                                </div>
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-select" name="id_kelas" id="id_kelas" aria-label="Default select example" required oninvalid="this.setCustomValidity('kelas tidak boleh kosong')" oninput="setCustomValidity('')">
                                    <option value="" selected>-pilih-</option>
                                    @foreach ($kelas as $k )
                                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
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
                    <div class="col-4 my-2">

                        <label for="searchKelas" class="form-label">Tampilkan Siswa</label>
                        <div class="input-group">
                            <select class="form-select" id="searchKelas" aria-label="Search by Class">
                                <option value="">-Pilih Kelas-</option>
                                @foreach ($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="dataTabel" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th width="5%">NO</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>No HandPhone</th>
                                <th>Alamat</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $index=>$si )
                            <tr>
                                <td>{{ $index+1}}</td>
                                <td>{{ $si->username}}</td>
                                <td>{{ $si->nama}}</td>
                                <td>{{ $si->nama_kelas}}</td>
                                <td>{{ $si->hp}}</td>
                                <td>{{ $si->alamat}}</td>
                                <td class="d-flex">
                                    <span>
                                        <button type="button" class="btn btn-primary m-md-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal{{ $si->id }}">
                                            Edit
                                        </button>
                                    </span>
                                    <form action="hapussiswa/{{$si->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger mt-2" type="submit"><i class="fas fa-trash-alt" onclick="javascript: return confirm('Anda yakin akan menghapus ini? ')">Hapus</i></button>
                                    </form>
                                    <div class="modal fade" id="exampleModal{{ $si->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit.siswa',['id'=>$si->id]) }}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{ method_field('PUT') }}
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="nama" class="form-label">Nama </label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $si->nama }}" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nis" class="form-label">NIS</label>
                                                                <input type="text" class="form-control" id="nis" name="nis" value="{{ $si->username }}" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">

                                                            </div>
                                                            <div class="col-12">
                                                                <label for="hp" class="form-label">Nomor Hp</label>
                                                                <input type="text" class="form-control" id="hp" name="hp" value="{{ $si->hp }}" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="alamat" class="form-label">Alamat</label>
                                                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $si->alamat }}" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="id_kelas" class="form-label">-kelompok pelajaran-</label>
                                                                <select class="form-select" name="id_kelas" id="id_kelas" aria-label="Default select example" required oninvalid="this.setCustomValidity('data tidak boleh kosong')" oninput="setCustomValidity('')">
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
                                </td>
                            </tr>
                            @endforeach
                    </table>
                </div>

            </div>

        </div>
    </div>
    @include('layouts.footer')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const searchKelas = document.getElementById("searchKelas");
            const dataTabel = document.getElementById("dataTabel");
    
            searchKelas.addEventListener("change", function() {
                const selectedKelas = searchKelas.value;
                if (selectedKelas) {
                    fetch(`/search?kelas=${selectedKelas}`)
                        .then(response => response.json())
                        .then(data => {
                            // Hapus semua baris dari tabel kecuali header
                            while (dataTabel.rows.length > 1) {
                                dataTabel.deleteRow(1);
                            }
    
                            // Tambahkan baris baru untuk setiap data siswa
                            data.forEach((siswa, index) => {
                                const row = dataTabel.insertRow();
                                row.insertCell().textContent = index + 1;
                                row.insertCell().textContent = siswa.username;
                                row.insertCell().textContent = siswa.user_nama;
                                row.insertCell().textContent = siswa.nama_kelas; // Pastikan ini adalah properti yang benar
                                row.insertCell().textContent = siswa.hp;
                                row.insertCell().textContent = siswa.alamat;
                                const actionsCell = row.insertCell();
                                actionsCell.innerHTML = `
                                <div class="d-flex">
                                    
                                    <form action="hapussiswa/{{$si->id }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger mt-2" type="submit"><i class="fas fa-trash-alt" onclick="javascript: return confirm('Anda yakin akan menghapus ini?')">Hapus</i></button>
                                    </form>
                                    <span>
                                        <button type="button" class="btn btn-primary m-md-2" data-coreui-toggle="modal" data-coreui-target="#exampleModal${siswa.id}">
                                            Edit
                                        </button>
                                    </span>
                                    <div class="modal fade" id="exampleModal${siswa.id}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Siswa</h5>
                                                    <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('edit.Bysiswa') }}" method="POST">
                                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                                        <input type="hidden" name="siswa_id" value="${siswa.id}">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <label for="nis" class="form-label">NIS</label>
                                                                <input type="text" class="form-control" id="nis" name="nis" value="${siswa.username}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="nama" class="form-label">Nama</label>
                                                                <input type="text" class="form-control" id="nama" name="nama" value="${siswa.user_nama}" required>
                                                            </div>
                                                            <div class="col-12">
                                                            <label for="id_kelas" class="form-label">Kelas</label>
                                                            <select class="form-select" name="id_kelas" id="id_kelas" required>
                                                                @foreach ($kelas as $k)
                                                                    <option value="{{ $k->id }}" ${siswa.id_kelas === {{ $k->id }} ? 'selected' : ''}>{{ $k->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                             </div>
                                                            <div class="col-12">
                                                                <label for="hp" class="form-label">No Hp</label>
                                                                <input type="text" class="form-control" id="hp" name="hp" value="${siswa.hp}" required>
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="alamat" class="form-label">Alamat</label>
                                                                <input type="text" class="form-control" id="alamat" name="alamat" value="${siswa.alamat}" required>
                                                            </div>
                                                            <!-- ... sisa input fields ... -->
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
                                </div>`;
                            });
                            
                        })
                        
                        .catch(error => {
                            console.error("Error fetching data:", error);
                        });
                }
            });
        });
    </script>
    
    



</div>
