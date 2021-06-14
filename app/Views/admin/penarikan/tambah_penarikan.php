<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Simpanan Dana</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted" aria-current="page">Simpanan</li>
            <li class="breadcrumb-item text-muted" aria-current="page">Penarikan</li>
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
              <h4 class="card-title">Penarikan Simpanan</h4>
              <h6 class="card-subtitle">Lengkapi form untuk membuat penarikan simpanan</h6>
            </div>
            <div class="col-sm-3 text-right">
                <a href="/penarikan"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="list" class="svg-icon"></i> List Simpanan</button></a>
            </div>
          </div>
          <hr>
          <form action="/penarikan" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="select1">ID Anggota</label>
              <select class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : '' ?>" id="select1" name="nik">
                  <option selected="">Choose...</option>
                  <?php
                    foreach ($anggota as $row) :
                  ?>
                      <option value="<?= $row['nik'] ?>"><?= $row['nik']. ' - '. $row['nama'] ?></option>
                  <?php
                    endforeach;
                  ?>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('nik') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="text1">Tanggal</label>
              <input type="date" class="form-control <?= ($validation->hasError('tgl')) ? 'is-invalid' : '' ?>" id="text1" name="tgl" value="<?= old('tgl') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('tgl') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="text1">Jumlah Penarikan</label>
              <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : '' ?>" id="text1" name="jumlah" value="<?= old('jumlah') ?>">
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
