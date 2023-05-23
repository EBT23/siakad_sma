
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
              <div class="row">
                <div class="col-6">
                  <label for="basic-url" class="form-label">NIY-Nama Guru</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                  </div>
                
                  <label for="tugas_tambahan" class="form-label">Pilih Pelajaran</label>
                  <select class="form-select" name="tugas_tambahan" id="tugas_tambahan" aria-label="Default select example">
                    <option selected>-pilih-</option>
                    <option value="1">MIPA 1</option>
                    <option value="2">MIPA 2</option>
                    <option value="3">MIPA 3</option>
                  </select>
                 
                </div>
                <div class="col-6">
                  <label for="basic-url" class="form-label">Jumlah Jam</label>
                  <div class="input-group mb-3">
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                  </div>

                  <label for="tugas_tambahan" class="form-label">Tugas Tambahan</label>
                  <select class="form-select" name="tugas_tambahan" id="tugas_tambahan" aria-label="Default select example">
                    <option selected>-pilih-</option>
                    <option value="1">MIPA 1</option>
                    <option value="2">MIPA 2</option>
                    <option value="3">MIPA 3</option>
                  </select>
                </div>
              </div>
             
            </div>
          
          </div>
<div class="card mb-4">
<div class="card-body">
  <table id="dataTabel" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Pelajaran</th>
        <th>Kelas</th>
        <th>Jumlah Jam</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      
      <tr>
        <td>Zorita Serrano</td>
        <td>Software Engineer</td>
        <td>San Francisco</td>
        <td>56</td>
        <td>2012-06-01</td>
        <td>$115,000</td>
      </tr>
      <tr>
        <td>Jennifer Acosta</td>
        <td>Junior Javascript Developer</td>
        <td>Edinburgh</td>
        <td>43</td>
        <td>2013-02-01</td>
        <td>$75,650</td>
      </tr>
      <tr>
        <td>Cara Stevens</td>
        <td>Sales Assistant</td>
        <td>New York</td>
        <td>46</td>
        <td>2011-12-06</td>
        <td>$145,600</td>
      </tr>
      <tr>
        <td>Hermione Butler</td>
        <td>Regional Director</td>
        <td>London</td>
        <td>47</td>
        <td>2011-03-21</td>
        <td>$356,250</td>
      </tr>
      <tr>
        <td>Lael Greer</td>
        <td>Systems Administrator</td>
        <td>London</td>
        <td>21</td>
        <td>2009-02-27</td>
        <td>$103,500</td>
      </tr>
      <tr>
        <td>Jonas Alexander</td>
        <td>Developer</td>
        <td>San Francisco</td>
        <td>30</td>
        <td>2010-07-14</td>
        <td>$86,500</td>
      </tr>
      <tr>
        <td>Shad Decker</td>
        <td>Regional Director</td>
        <td>Edinburgh</td>
        <td>51</td>
        <td>2008-11-13</td>
        <td>$183,000</td>
      </tr>
      <tr>
        <td>Michael Bruce</td>
        <td>Javascript Developer</td>
        <td>Singapore</td>
        <td>29</td>
        <td>2011-06-27</td>
        <td>$183,000</td>
      </tr>
      <tr>
        <td>Donna Snider</td>
        <td>Customer Support</td>
        <td>New York</td>
        <td>27</td>
        <td>2011-01-25</td>
        <td>$112,000</td>
      </tr>
    </tbody>
    <tfoot>
      <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Office</th>
        <th>Age</th>
        <th>Start date</th>
        <th>Salary</th>
      </tr>
    </tfoot>
  </table>      
</div>
  
</div>
        
        </div>
      </div>

      
      <footer class="footer">
        <div><a href="https://coreui.io">CoreUI </a><a href="https://coreui.io">Bootstrap Admin Template</a> © 2022 creativeLabs.</div>
        <div class="ms-auto">Powered by&nbsp;<a href="https://coreui.io/docs/">CoreUI UI Components</a></div>
      </footer>
    </div>
