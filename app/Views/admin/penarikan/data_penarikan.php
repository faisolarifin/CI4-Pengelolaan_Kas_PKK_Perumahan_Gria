<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Penarikan</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted" aria-current="page">Simpanan</li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Penarikan</li>
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
                  <h4 class="card-title">Penarikan Simpanan</h4>
<!--                  <h6 class="card-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, voluptatibus..</h6>-->
               </div>
               <div class="col-sm-3 text-right">
                   <a href="/penarikan/tambah"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="plus-circle" class="svg-icon"></i> Tarik</button></a>
               </div>
           </div>
          <div class="table-responsive mt-4">
            <table class="table table-striped" id="datatabel">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Penarikan</th>
                    <th scope="col">Jumlah Uang</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($data as $row):
                  ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['tgl_trans'] ?></td>
                        <td>Rp. <?= number_format($row['jumlah']) ?></td>
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
