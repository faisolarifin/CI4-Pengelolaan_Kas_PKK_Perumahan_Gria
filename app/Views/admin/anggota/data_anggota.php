<?= $this->extend('layouts/adminmart_template') ?>

<?= $this->section('content') ?>
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
  <div class="row">
    <div class="col-7 align-self-center">
      <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Anggota</h4>
      <div class="d-flex align-items-center">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb m-0 p-0">
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Anggota</li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="col-5 align-self-center">
      <div class="customize-input float-right">
<!--        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">-->
<!--          <option selected>Aug 19</option>-->
<!--          <option value="1">July 19</option>-->
<!--          <option value="2">Jun 19</option>-->
<!--        </select>-->
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
                  <h4 class="card-title">Jurnal</h4>
<!--                  <h6 class="card-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, voluptatibus..</h6>-->
               </div>
               <div class="col-sm-3 text-right">
                   <a href="/anggota/tambah"><button class="btn btn-primary custom-radius custom-shadow"> <i data-feather="plus-circle" class="svg-icon"></i> Tambah</button></a>
               </div>
           </div>
          <div class="table-responsive mt-4">
            <table class="table table-striped" id="datatabel">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Telp</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Username</th>
                    <th scope="col">Tanggal Registasi</th>
                    <th scope="col">Role</th>
                    <th scope="col" width="80px" class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($anggota as $row):
                  ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $row['nik'] ?></td>
                        <td><?= $row['nama'] ?></td>
                        <td><?= $row['telp'] ?></td>
                        <td><?= $row['alamat'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $basic->myDate($row['tgl_registrasi']) ?></td>
                        <td><?= $row['role'] ?></td>
                        <td class="text-center">
                            <form action="<?= base_url("anggota/{$row['nik']}") ?>" method="post" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-sm btn-danger"> <i data-feather="delete" class="svg-icon"></i> </button>
                            </form>
                            <a href="<?= base_url("anggota/{$row['nik']}/edit") ?>"><button class="btn btn-sm btn-primary my-1"> <i data-feather="edit" class="svg-icon"></i> </button></a>
                        </td>
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
