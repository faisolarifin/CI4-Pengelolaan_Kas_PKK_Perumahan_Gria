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
            <li class="breadcrumb-item"><a href="/" class="text-muted">Home</a></li>
            <li class="breadcrumb-item text-muted active" aria-current="page">Pinjaman</li>
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
                  <h4 class="card-title">Pinjaman</h4>
<!--                  <h6 class="card-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, voluptatibus..</h6>-->
               </div>
           </div>
          <div class="table-responsive mt-4">
            <table class="table table-striped" id="datatabel">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <!-- <th scope="col">NIK</th> -->
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Jatuh Tempo</th>
                    <th scope="col">Lama</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Total Bayar</th>
                    <th scope="col">Sisa Angsuran</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                foreach ($data as $row):
                  ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <!-- <td><?= $row['nik'] ?></td> -->
                        <td><?= $row['nama'] ?></td>
                        <td><?= $basic->myDate($row['tgl_pinjam']) ?></td>
                        <td><?= $basic->myDate($row['jatuh_tempo']) ?></td>
                        <td><?= $row['lama'] ?> bulan</td>
                        <td>Rp. <?= number_format($row['jumlah']) ?></td>
                        <td>Rp. <?= number_format($row['total_bayar']) ?></td>
                        <td>Rp. <?= number_format($row['sisa']) ?></td>
                        <td>
                          <?php
                            if ($row['status']=='pending') :
                              echo "<span class='badge badge-primary'>$row[status]</span>";
                            elseif ($row['status']=='pinjam') :
                              echo "<span class='badge badge-warning'>$row[status]</span>";
                            elseif ($row['status']=='lunas') :
                              echo "<span class='badge badge-success'>$row[status]</span>";
                            elseif ($row['status']=='tolak') :
                              echo "<span class='badge badge-danger'>$row[status]</span>";
                            endif;
                          ?> 
                        </td>
                        <td class="text-center">
                            <?php
                              if ($row['status'] == 'pending') :
                            ?>
                            <form action="<?= base_url("pinjaman/{$row['id_pinjam']}/konfir") ?>" method="post" class="d-inline">
                                <input type="hidden" name="_method" value="PUT">
                                <button class="btn btn-sm btn-warning"> <i data-feather="check" class="svg-icon"></i> </button>
                            </form>
                            <form action="<?= base_url("pinjaman/{$row['id_pinjam']}/tolak") ?>" method="post" class="d-inline">
                                <input type="hidden" name="_method" value="PUT">
                                <button class="btn btn-sm btn-danger"> <i data-feather="x" class="svg-icon"></i> </button>
                            </form>
                            <?php
                              elseif ($row['status']=='pinjam') :
                            ?>
                            <form action="<?= base_url("pinjaman/{$row['id_pinjam']}/lunas") ?>" method="post" class="d-inline">
                                <input type="hidden" name="_method" value="PUT">
                                <button class="btn btn-sm btn-success"> <i data-feather="check-circle" class="svg-icon"></i> </button>
                            </form>
                            <?php
                              endif;
                            ?>
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
