
    @extends('layouts.base')
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="row">
            <div class="col-sm-6 col-lg-6" >
              <div class="card mb-4 text-white bg-primary" align="center">
                <h1>  {{$guru}} </h1><br>
                <h4> Jumlah Guru </h4>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-6">
              <div class="card mb-3 text-white bg-info" align="center">
                        <h1>  {{$siswa}} </h1><br>
                        <h4> Jumlah Siswa </h4>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-6">
              <div class="card mb-4 text-white bg-warning" align="center">
                <h1>  {{$kelas}} </h1><br>
                <h4> Jumlah Kelas </h4>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-6">
              <div class="card mb-4 text-white bg-danger" align="center">
                <h1>  {{$siswa}} </h1><br>
                <h4> Jumlah Siswa </h4>
              </div>
            </div>
            <!-- /.col-->
          </div>
        </div>
      </div>
      
      @include('layouts.footer')
    </div>
