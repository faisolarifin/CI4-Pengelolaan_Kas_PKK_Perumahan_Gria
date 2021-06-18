<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Anggota</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Kas</li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
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
              <h4 class="card-title">Setting</h4>
              <h6 class="card-subtitle">Ubah nilai pada form untuk mengganti settingan</h6>
            </div>
          </div>
          <hr>
            <form action="/setting" method="post">
              <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="text1">Bunga Pinjaman</label>
                      <input type="text" class="form-control <?= ($validation->hasError('bunga')) ? 'is-invalid' : '' ?>" id="text1" name="bunga" value="<?= (old('bunga')) ? old('bunga') : $data[0]['value'] ?>">
                        <div class="invalid-feedback">
                          <?= $validation->getError('bunga') ?>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="text1">Simpanan Pokok</label>
                      <input type="text" class="form-control <?= ($validation->hasError('pokok')) ? 'is-invalid' : '' ?>" id="text1" name="pokok" value="<?= (old('pokok')) ? old('pokok') : $data[1]['value'] ?>">
                        <div class="invalid-feedback">
                          <?= $validation->getError('pokok') ?>
                        </div>
                    </div>
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
