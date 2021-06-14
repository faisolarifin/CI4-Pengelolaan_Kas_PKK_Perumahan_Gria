<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Transaksi Angsuran</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted" aria-current="page">Pinjaman</li>
            <li class="breadcrumb-item text-muted" aria-current="page">Angsuran</li>
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
              <h4 class="card-title">Tambah Angsuran</h4>
              <h6 class="card-subtitle">Lengkapi form untuk membuat transaksi angsuran pinjaman</h6>
            </div>
            <div class="col-sm-3 text-right">
                <a href="/angsuran"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="list" class="svg-icon"></i> List Angsuran</button></a>
            </div>
          </div>
          <hr>
          <form action="/angsuran" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="select-1">ID Anggota</label>
              <select class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : '' ?>" id="select-1" name="nik">
                  <option value="" selected>Choose...</option>
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
              <label for="kode">Kode Pinjam</label>
              <input type="text" class="form-control <?= ($validation->hasError('kode')) ? 'is-invalid' : '' ?>" id="kode" name="kode" value="<?= old('kode') ?>" readonly>
                <div class="invalid-feedback">
                  <?= $validation->getError('kode') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="tanggal">Tanggal</label>
              <input type="date" class="form-control <?= ($validation->hasError('tgl')) ? 'is-invalid' : '' ?>" id="tanggal" name="tgl" value="<?= old('tgl') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('tgl') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="ke">Angsuran ke</label>
              <input type="text" class="form-control <?= ($validation->hasError('angsur')) ? 'is-invalid' : '' ?>" id="ke" name="angsur" value="<?= old('angsur') ?>" readonly>
                <div class="invalid-feedback">
                  <?= $validation->getError('angsur') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="jumlah">Jumlah</label>
              <input type="text" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" value="<?= old('jumlah') ?>" readonly>
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
