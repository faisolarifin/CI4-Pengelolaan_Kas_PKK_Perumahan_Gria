<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pembagian SHU</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">SHU</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-5 align-self-center">
      <div class="customize-input float-right">
<!--        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">-->
<!--          <option selected>Aug 19</option>-->
<!--          <option value="1">July 19</option>-->
<!--          <option value="2">Jun 19</option>-->
<!--        </select>-->
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
           <div class="row mb-2">
               <div class="col-sm-9">
                  <h4 class="card-title">SHU</h4>
<!--                  <h6 class="card-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, voluptatibus..</h6>-->
               </div>
               <div class="col-sm-3 text-right">
                   <a href="/shu/reset"><button class="btn btn-danger custom-radius custom-shadow"> <i data-feather="refresh-cw" class="svg-icon"></i> Reset</button></a>
               </div>
           </div>
           <form action="/shu/bagi" method="post">
            <div class="row">
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="text1">Jumlah SHU</label>
                  <input type="number" class="form-control" id="text1" name="jumlah" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="text1">Jasa Modal</label>
                  <input type="number" class="form-control" id="text1" name="jasamodal" required>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="form-group">
                  <label for="text1">&nbsp;</label>
                  <button class="btn btn-primary d-block" type="submit">Bagi SHU</button>
                </div>
              </div>
            </div>
          </form> 
          <div class="table-responsive mt-4">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Total Simpanan</th>
                    <th scope="col">SHU diperoleh</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($data as $row):
                  ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td>Rp. <?= number_format($row['tot_simpan']) ?></td>
                        <td>Rp. <?= number_format($row['jml_shu']) ?></td>
                       
                    </tr>
                <?php
                endforeach;
                ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<?= $this->endSection() ?>
