<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<div class="container-fluid">
  <!-- *************************************************************** -->
  <!-- Start First Cards -->
  <!-- *************************************************************** -->
  <div class="card-group">
    <div class="card border-right">
      <div class="card-body">
        <div class="d-flex d-lg-flex d-md-block align-items-center">
          <div>
            <div class="d-inline-flex align-items-center">
              <h2 class="text-dark mb-1 font-weight-medium"><?= $anggota ?></h2>
            </div>
            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Jumlah Anggota</h6>
          </div>
          <div class="ml-auto mt-md-3 mt-lg-0">
            <span class="opacity-7 text-muted"><i data-feather="book"></i></span>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <div class="d-flex d-lg-flex d-md-block align-items-center">
          <div>
            <h2 class="text-dark mb-1 font-weight-medium">Rp. <?= number_format($simpan) ?></h2>
            <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Total Simpanan</h6>
          </div>
          <div class="ml-auto mt-md-3 mt-lg-0">
            <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- *************************************************************** -->
  <!-- End First Cards -->
  <!-- *************************************************************** -->
  <div class="row">
    <!-- column -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Site Visitor</h4>
          <ul class="list-inline text-right">
            <li class="list-inline-item">
              <h5><svg width="1em" height="1em" viewBox="0 0 16 16" class="mr-1 text-info bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="8" cy="8" r="8"/>
                </svg>
                <i class="fa fa-circle "></i>
                Site A View</h5>
            </li>
            <li class="list-inline-item">
              <h5><svg width="1em" height="1em" viewBox="0 0 16 16" class="mr-1 text-cyan bi bi-circle-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <circle cx="8" cy="8" r="8"/>
                </svg>
                Site B View</h5>
            </li>
          </ul>
          <div id="morris-area-chart2"></div>
        </div>
      </div>
    </div>
    <!-- column -->
  </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<?= $this->endSection() ?>
