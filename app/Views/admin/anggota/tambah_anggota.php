<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Anggota</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="index.html" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Anggota</li>
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
              <h4 class="card-title">Tambah Anggota</h4>
              <h6 class="card-subtitle">Lengkapi form untuk menambahkan data jurnal</h6>
            </div>
            <div class="col-sm-3 text-right">
                <a href="/anggota"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="list" class="svg-icon"></i> List Anggota</button></a>
            </div>
          </div>
          <hr>
          <form action="/anggota" method="post">
            <?= csrf_field(); ?>
            <div class="form-group">
              <label for="text1">NIK</label>
              <input type="text" class="form-control <?= ($validation->hasError('nik')) ? 'is-invalid' : '' ?>" id="text1" name="nik" value="<?= old('nik') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('nik') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="text1">Nama</label>
              <input type="text" class="form-control <?= ($validation->hasError('nama')) ? 'is-invalid' : '' ?>" id="text1" name="nama" value="<?= old('nama') ?>">
              <div class="invalid-feedback">
                <?= $validation->getError('nama') ?>
              </div>
            </div>
            <div class="form-group">
              <label for="text1">Username</label>
              <input type="text" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" id="text1" name="username" value="<?= old('username') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('username') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="text1">Password</label>
              <input type="text" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" id="text1" name="password" value="<?= old('password') ?>">
                <div class="invalid-feedback">
                  <?= $validation->getError('password') ?>
                </div>
            </div>
            <div class="form-group">
              <label for="select1">Role</label>
              <select class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : '' ?>" id="select1" name="role">
                  <option selected="">Choose...</option>
                  <option value="anggota">Anggota</option>
                  <option value="admin">Admin</option>
              </select>
              <div class="invalid-feedback">
                <?= $validation->getError('role') ?>
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
