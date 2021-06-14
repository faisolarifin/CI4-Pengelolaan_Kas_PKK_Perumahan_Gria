<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Kas</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Kas</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-5 align-self-center">
      <div class="customize-input float-right">

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
               <div class="col-sm-10">
                  <h4 class="card-title">Kas</h4>
<!--                  <h6 class="card-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, voluptatibus..</h6>-->
               </div>
               <div class="col-sm-2 text-right">
                <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius" onchange="location = this.value;">
                  <?php
                    foreach($periode as $row):
                  ?>
                    <option value="/kas/<?= $row['id_saldo'] ?>" <?= $request->uri->getSegment(2)==$row['id_saldo'] ? 'selected' : '' ?>><?= $row['bulan']. ' | '.$row['tahun'] ?></option>
                  <?php
                    endforeach;
                  ?>
                </select>
               </div>
           </div>
          <div class="table-responsive mt-4">
            <table class="table table-striped" id="datatabel">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Keterangan</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($kas as $row):
                  ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $row['tipe'] ?></td>
                        <td><?= $basic->myDate($row['tgl']) ?></td>
                        <td><?= $row['tipe']=='pemasukan' ? '+' : '-'; ?> Rp. <?= number_format($row['jml_uang']) ?></td>
                        <td><?= $row['keterangan'] ?></td>
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
