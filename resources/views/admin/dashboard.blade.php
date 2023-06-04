
    @extends('layouts.base')
    @include('layouts.sidebar')
    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
      @include('layouts.header')
      <div class="body flex-grow-1 px-3">
        <div class="container-lg">
          <div class="row">
            <div class="col-sm-6 col-lg-6" >
              <div class="card mb-4 text-white bg-primary">
                <div class="card-body pb-0 d-flex justify-content-center align-items-start">
                  <div >
                    <div class="fs-4 fw-semibold">26K </span></div>
                    <h6>Jumlah Guru</h6>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-6">
              <div class="card mb-4 text-white bg-info">
                <div class="card-body pb-0 d-flex justify-content-center align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">$6.200 <span class="fs-6 fw-normal"></div>
                        <h6>Jumlah Siswa</h6>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-6">
              <div class="card mb-4 text-white bg-warning">
                <div class="card-body pb-0 d-flex justify-content-center align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">2.49% <span class="fs-6 fw-normal"></div>
                        <h6>Jumlah Siswa</h6>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
            <div class="col-sm-6 col-lg-6">
              <div class="card mb-4 text-white bg-danger">
                <div class="card-body pb-0 d-flex justify-content-center align-items-start">
                  <div>
                    <div class="fs-4 fw-semibold">44K <span class="fs-6 fw-normal"></div>
                        <h6>Jumlah Siswa</h6>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.col-->
          </div>
          
        </div>
      </div>

      
      @include('layouts.footer')
    </div>
