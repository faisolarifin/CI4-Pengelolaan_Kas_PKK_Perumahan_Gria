<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Pinjaman</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Pinjaman</li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Pinjam</li>
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
              <h4 class="card-title">Pinjam Dana</h4>
              <h6 class="card-subtitle">Lengkapi form untuk mengajukan peminjaman uang</h6>
            </div>
            <div class="col-sm-3 text-right">
                <a href="/pinjaman"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="list" class="svg-icon"></i> List Pinjaman</button></a>
            </div>
          </div>
          <hr>
          <form action="/pinjam" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="text1">Tanggal</label>
              <input type="date" class="form-control <?= ($validation->hasError('tgl')) ? 'is-invalid' : '' ?>" id="text1" name="tgl" value="<?= old('tgl') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('tgl') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="text1">Jumlah</label>
              <input type="text" class="form-control <?= ($validation->hasError('jml')) ? 'is-invalid' : '' ?>" id="text1" name="jml" value="<?= old('jml') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('jml') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="text1">Lama (/bulan)</label>
              <input type="number" class="form-control <?= ($validation->hasError('jml')) ? 'is-invalid' : '' ?>" id="text1" name="lama" value="<?= old('lama') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('lama') ?>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Ajukan Pinjaman</button>
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
