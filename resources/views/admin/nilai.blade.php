@extends('layouts.base')
@include('layouts.sidebar')
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
  @include('layouts.header')
  <div class="body flex-grow-1 px-3">
    <div class="container-lg">

      <!-- /.row-->

      <h3>
        {{ $title }}</h3>
      <hr>
      <div class="my-2">
        <button type="button" class="btn btn-success text-white" data-coreui-toggle="modal"
          data-coreui-target="#exampleModal">
          Tambah Nilai +
        </button>
      </div>
      <form action="{{ route('nilai.post') }}" method="post">
        @csrf
        <div class="row">
          <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                  <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-6">
                      <label for="kelas" class="form-label">Kelas</label>
                      <select class="form-select" aria-label="Default select example" name="id_kelas" id="id_kelas"
                        required oninvalid="this.setCustomValidity('kelas tidak boleh kosong')"
                        oninput="setCustomValidity('')">
                        <option value="" selected>pilih kelas</option>
                        @foreach ($kelas as $si )
                        <option value="{{ $si->id }}">{{ $si->nama }}</option>
                        @endforeach
                      </select>
                      <label for="id_users" class="form-label">Siswa</label>
                      <select class="form-select" aria-label="Default select example" name="id_users" id="id_users"
                        required oninvalid="this.setCustomValidity('Siswa tidak boleh kosong')"
                        oninput="setCustomValidity('')" disabled>
                        <option value="" selected>pilih siswa</option>
                      </select>
                      <label for="kd_pelajaran" class="form-label">Pelajaran</label>
                      <select class="form-select" aria-label="Default select example" name="kd_pelajaran"
                        id="kd_pelajaran" required oninvalid="this.setCustomValidity('pelajaran tidak boleh kosong')"
                        oninput="setCustomValidity('')">
                        <option value="" selected>pilih pelajaran</option>
                        @foreach ($pelajaran as $p )
                        <option value="{{ $p->kode }}">{{ $p->nama }} - {{ $p->kode }} </option>
                        @endforeach
                      </select>

                    </div>
                    <div class="col-6">
                      <label for="rph" class="form-label">Nilai RPH</label>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control" id="rph" name="rph" aria-describedby="basic-addon3"
                          required oninvalid="this.setCustomValidity('Nilai RPH tidak boleh kosong')"
                          oninput="setCustomValidity('')">
                      </div>

                      <label for="pts" class="form-label">Nilai PTS</label>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control" id="pts" name="pts" aria-describedby="basic-addon3"
                          required oninvalid="this.setCustomValidity('Nilai PTS tidak boleh kosong')"
                          oninput="setCustomValidity('')">
                      </div>

                      <label for="pat" class="form-label">Nilai PAT</label>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control" id="pat" name="pat" aria-describedby="basic-addon3"
                          required oninvalid="this.setCustomValidity('Nilai PAT tidak boleh kosong')"
                          oninput="setCustomValidity('')">
                      </div>
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
        </div>
      </form>

    </div>
    <div class="card mb-4">

      <div class="card-body">
        <a href="/export-nilai" class="btn btn-success my-3 text-white" target="_blank">EXPORT EXCEL</a>
        <table id="dataTabel" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Kode Pelajaran</th>
              <th>RPH</th>
              <th>PTS</th>
              <th>PAT</th>
              <th>Jumlah</th>
              <th>Rata-Rata</th>
              <th>Predikat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($nilai as $index=> $n )
            <tr>
              <td>{{ $index+1 }}</td>
              <td>{{ $n->nama}}</td>
              <td>{{ $n->kode}}</td>
              <td>{{ $n->rph}}</td>
              <td>{{ $n->pts}}</td>
              <td>{{ $n->pat}}</td>
              <td>{{ $n->jumlah}}</td>
              <td>{{ $n->rata_rata}}</td>
              @if ($n->rata_rata >=91 && $n->rata_rata<=100) <td>A</td>
                @elseif ($n->rata_rata>=81 && $n->rata_rata<=90) <td>B</td>
                  @elseif ($n->rata_rata>=71 && $n->rata_rata<=80) <td>C</td>
                    @elseif ($n->rata_rata>=61 && $n->rata_rata<=70) <td>D</td>
                      @elseif ($n->rata_rata<=60) <td>E</td>
                        @else
                        <td>Belum Dinilai</td>

                        @endif
                        <td class="d-flex">
                          <form action="hapusnilai/{{$n->id }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt">Hapus</i></button>
                          </form>
                          <span>
                            <button type="button" class="btn btn-primary mx-2" data-coreui-toggle="modal"
                              data-coreui-target="#exampleModal{{ $n->id }}">
                              Edit
                            </button>
                          </span>
                          <div class="modal fade" id="exampleModal{{ $n->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Edit Nilai</h5>
                                  <button type="button" class="btn-close" data-coreui-dismiss="modal"
                                    aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <form action="{{ route('edit.nilai',['id'=>$n->id]) }}" method="POST">
                                    @csrf
                                    <div class="row">
                                      {{-- <div class="col-6">
                                        <label for="id_users" class="form-label">Siswa</label>
                                        <select class="form-select" aria-label="Default select example" name="id_users"
                                          id="id_users" disabled selected>
                                          <option selected>pilih siswa</option>
                                          @foreach ($siswa as $si )
                                          <option @if($si->id == $n->id_users )selected @endif value="{{ $si->id }}">{{
                                            $si->nama }}</option>
                                          @endforeach
                                        </select>

                                        <label for="kd_pelajaran" class="form-label">Pelajaran</label>
                                        <select class="form-select" aria-label="Default select example"
                                          name="kd_pelajaran" id="kd_pelajaran" disabled selected>
                                          <option selected>pilih pelajaran</option>
                                          @foreach ($pelajaran as $p )
                                          <option @if($p->kode == $n->kd_pelajaran) selected @endif value="{{ $p->kode
                                            }}">{{ $p->kode }} </option>
                                          @endforeach
                                        </select>
                                      </div> --}}

                                      <div class="col-12">
                                        <label for="rph" class="form-label">Nilai RPH</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" id="rph" name="rph"
                                            value="{{ $n->rph }}" aria-describedby="basic-addon3">
                                        </div>
                                        <label for="pts" class="form-label">Nilai PTS</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" id="pts" name="pts"
                                            value="{{ $n->pts }}" aria-describedby="basic-addon3">
                                        </div>

                                        <label for="pat" class="form-label">Nilai PAT</label>
                                        <div class="input-group mb-3">
                                          <input type="number" class="form-control" id="pat" name="pat"
                                            value="{{ $n->pat }}" aria-describedby="basic-addon3">
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary"
                                        data-coreui-dismiss="modal">Close</button>
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
  @include('layouts.footer')
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function () {
        $('#id_kelas').on('change', function () {
            let kelasId = $(this).val();
            
            // Buat permintaan Ajax ke rute yang ditentukan sebelumnya
            $.ajax({
                url: "{{ route('get.siswa') }}",
                type: 'GET',
                data: {id_kelas: kelasId},
                success: function (response) {
                    // Aktifkan select siswa
                    $('#id_users').prop('disabled', false);

                    // Hapus semua opsi saat ini
                    $('#id_users option').not(':first').remove();

                    // Tambahkan opsi baru berdasarkan respons dari permintaan Ajax
                    $.each(response, function (key, value) {
                        $('#id_users').append('<option value="' + value.id + '">' + value.nama + '</option>');
                    });
                }
            });
        });
    });
</script>
</div>
