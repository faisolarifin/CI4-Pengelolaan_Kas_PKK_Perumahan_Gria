<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Kas</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Kas</li>
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
              <h4 class="card-title">Tambah Kas</h4>
              <h6 class="card-subtitle">Lengkapi form untuk menambahkan data kas</h6>
            </div>
            <div class="col-sm-3 text-right">
                <a href="/kas"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="list" class="svg-icon"></i> List Kas</button></a>
            </div>
          </div>
          <hr>
          <form action="/kas" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="select1">Periode</label>
              <select class="form-control <?= ($validation->hasError('periode')) ? 'is-invalid' : '' ?>" id="select1" name="periode">
                  <option value="" selected="">Choose...</option>
                  <?php
                    foreach ($data as $row) :
                      echo "<option value='{$row['id_saldo']}'>{$row['bulan']} | {$row['tahun']}</option>";
                    endforeach;
                  ?>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('periode') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="select1">Tipe</label>
              <select class="form-control <?= ($validation->hasError('tipe')) ? 'is-invalid' : '' ?>" id="select1" name="tipe">
                  <option value="" selected="">Choose...</option>
                  <option value="debit">Debit</option>
                  <option value="kredit">Kredit</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('tipe') ?>
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
              <label for="text1">Jumlah Uang</label>
              <input type="text" class="form-control <?= ($validation->hasError('jml')) ? 'is-invalid' : '' ?>" id="text1" name="jml" value="<?= old('jml') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('jml') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="text1">Keterangan</label>
              <input type="text" class="form-control <?= ($validation->hasError('keterangan')) ? 'is-invalid' : '' ?>" id="text1" name="keterangan" value="<?= old('keterangan') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('keterangan') ?>
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
