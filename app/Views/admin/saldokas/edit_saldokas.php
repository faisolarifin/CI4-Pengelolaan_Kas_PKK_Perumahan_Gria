<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Ubah Saldo Kas</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted" aria-current="page">Kas</li>
            <li class="breadcrumb-item text-muted" aria-current="page">Saldo</li>
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
              <h4 class="card-title">Edit Simpanan</h4>
              <h6 class="card-subtitle">Ganti isian pada form untuk merubah kas</h6>
            </div>
            <div class="col-sm-3 text-right">
                <a href="/saldokas"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="list" class="svg-icon"></i> List Simpanan</button></a>
            </div>
          </div>
          <hr>
            <form action="/saldokas" method="post">
              <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="id" value="<?= $data['id_saldo'] ?>">
                <div class="form-group">
                  <label for="select1">Bulan</label>
                  <select class="form-control <?= ($validation->hasError('bulan')) ? 'is-invalid' : '' ?>" id="select1" name="bulan">
                      <option value="" selected="">Choose...</option>
                      <option value="Januari" <?= $data['bulan']=='Januari' ? 'selected' : '' ?>>Januari</option>
                      <option value="Februari" <?= $data['bulan']=='Februari' ? 'selected' : '' ?>>Februari</option>
                      <option value="Maret" <?= $data['bulan']=='Maret' ? 'selected' : '' ?>>Maret</option>
                      <option value="April" <?= $data['bulan']=='April' ? 'selected' : '' ?>>April</option>
                      <option value="Mei" <?= $data['bulan']=='Mei' ? 'selected' : '' ?>>Mei</option>
                      <option value="Juni" <?= $data['bulan']=='Juni' ? 'selected' : '' ?>>Juni</option>
                      <option value="Juli" <?= $data['bulan']=='Juli' ? 'selected' : '' ?>>Juli</option>
                      <option value="Agustus" <?= $data['bulan']=='Agustus' ? 'selected' : '' ?>>Agustus</option>
                      <option value="September" <?= $data['bulan']=='September' ? 'selected' : '' ?>>September</option>
                      <option value="Oktober" <?= $data['bulan']=='Oktober' ? 'selected' : '' ?>>Oktober</option>
                      <option value="November" <?= $data['bulan']=='November' ? 'selected' : '' ?>>November</option>
                      <option value="Desember" <?= $data['bulan']=='Desember' ? 'selected' : '' ?>>Desember</option>
                  </select>
                  <div class="invalid-feedback">
                    <?= $validation->getError('bulan') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label for="text1">Tahun</label>
                  <input type="number" class="form-control <?= ($validation->hasError('tahun')) ? 'is-invalid' : '' ?>" id="text1" name="tahun" value="<?= (old('tahun')) ? old('tahun') : $data['tahun'] ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('tahun') ?>
                    </div>
                </div>
                <div class="form-group">
                  <label for="text1">Jumlah Saldo</label>
                  <input type="number" class="form-control <?= ($validation->hasError('jumlah')) ? 'is-invalid' : '' ?>" id="text1" name="jumlah" value="<?= (old('jumlah')) ? old('jumlah') : $data['jumlah'] ?>">
                    <div class="invalid-feedback">
                      <?= $validation->getError('jumlah') ?>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit">Ubah</button>
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
