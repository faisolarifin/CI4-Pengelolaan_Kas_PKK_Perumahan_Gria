<?php 

namespace App\Controllers;

use App\Models\AngsuranModel;
use App\Models\PinjamanModel;
use App\Models\AnggotaModel;
use App\Libraries\LibBasic;
use App\Controllers\BaseController;


class Angsuran extends BaseController
{

  public function __construct()
  {
    // $session = \Config\Services::session();
    // if (!$session->has('id')) {
    //   throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //   die;
    // }
    $this->angsur = new AngsuranModel();
    $this->pinjam = new PinjamanModel();
    $this->anggota = new AnggotaModel();
    $this->basic = new LibBasic();
  }

  public function index()
	{
		return view('admin/angsuran/data_angsuran', [
      'data' => $this->angsur->findAll(),
      'basic' => $this->basic
    ]);
	}

  public function tambah()
  {
    return view('admin/angsuran/tambah_angsuran', [
      'anggota' => $this->anggota->find(),
      'validation' => \Config\Services::validation()
    ]);
  }

  public function save()
  {
    //validate
    if (!$this->validate([
      'nik' => ['label' => 'NIK', 'rules' => 'required'],
      'kode' => ['label' => 'Kode Anggota', 'rules' => 'required'],
      'tgl' => ['label' => 'Tanggal', 'rules' => 'required'],
      'angsur' => ['label' => 'Angsuran ke', 'rules' => 'required'],
      'jumlah' => ['label' => 'Jumlah', 'rules' => 'required'],
    ])) {
      return redirect()->to('/angsuran/tambah')->withInput();
    }

    $sisa = $this->pinjam->select('sisa')->where('nik', $this->request->getPost('nik'))->find()[0]['sisa'] - $this->request->getPost('jumlah');

    $this->pinjam->update($this->request->getPost('kode'), [
      'sisa' => $sisa,
      'status' => $sisa==0 ? 'lunas' : 'pinjam',
    ]);

    $this->angsur->save([
      'nik' => $this->request->getPost('nik'),
      'id_pinjam' => $this->request->getPost('kode'),
      'tanggal' => $this->request->getPost('tgl'),
      'angsuran_ke' => $this->request->getPost('angsur'),
      'jumlah' => $this->request->getPost('jumlah'),
    ]);

    return redirect()->to('/angsuran');
  }

  public function angsuran_api()
	{
    $nik = $this->request->getPost('nik');
    $ke = 1;
    $pinjam=$this->pinjam->select('id_pinjam, lama, jumlah, sisa')->where([
      'nik' => $nik,
      'status' => 'pinjam'
    ])->find();

    if ($pinjam != null)
    {
      $pinjam=$pinjam[0];
      $angsuranke=$this->angsur->selectMax('angsuran_ke')->where(
        ['id_pinjam' => $pinjam['id_pinjam']]
      )->find()[0];

      if ($angsuranke['angsuran_ke'] !== NULL)
      {
        $ke = ++$angsuranke['angsuran_ke'];
      }

      $pinjam['ke'] = $ke;
      $pinjam['bayar'] = $this->basic->hitungBunga($pinjam['jumlah'], 3, $pinjam['lama'], $ke);

      $api['status'] = TRUE;
      $api['data'] = $pinjam;
      echo json_encode($api);

    } else {
      $api['status'] = FALSE;
      $api['data'] = NULL;
      echo json_encode($api);
    }
  }


}