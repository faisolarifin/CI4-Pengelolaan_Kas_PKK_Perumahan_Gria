<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Saldo Kas</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted" aria-current="page">Kas</li>
            <li class="breadcrumb-item text-muted" aria-current="page">Saldo</li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Add</li>
          </ol>
        </nav>
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
              <h4 class="card-title">Saldo Kas Baru</h4>
              <h6 class="card-subtitle">Lengkapi form untuk menambahkan data saldo kas</h6>
            </div>
            <div class="col-sm-3 text-right">
                <a href="/simpanan"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="list" class="svg-icon"></i> List Saldo</button></a>
            </div>
          </div>
          <hr>
          <form action="/saldokas" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="select1">Bulan</label>
              <select class="form-control <?= ($validation->hasError('bulan')) ? 'is-invalid' : '' ?>" id="select1" name="bulan">
                  <option selected="">Choose...</option>
                  <option value="Januari">Januari</option>
                  <option value="Februari">Februari</option>
                  <option value="Maret">Maret</option>
                  <option value="April">April</option>
                  <option value="Mei">Mei</option>
                  <option value="Juni">Juni</option>
                  <option value="Juli">Juli</option>
                  <option value="Agustus">Agustus</option>
                  <option value="September">September</option>
                  <option value="Oktober">Oktober</option>
                  <option value="November">November</option>
                  <option value="Desember">Desember</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('role') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="text1">Tahun</label>
              <input type="number" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : '' ?>" id="text1" name="tahun" value="<?= old('tahun') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('tahun') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="text1">Jumlah Saldo</label>
              <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : '' ?>" id="text1" name="jumlah" value="<?= old('jumlah') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('jumlah') ?>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Simpan</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>

<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
<?= $this->endSection() ?>
