<?php 

namespace App\Controllers;

use App\Models\SimpananModel;
use App\Models\AnggotaModel;
use App\Models\SimpananTotalModel;
use App\Models\PenarikanModel;
use App\Libraries\LibBasic;
use App\Controllers\BaseController;


class Simpanan extends BaseController
{

  public function __construct()
  {
    $session = \Config\Services::session();
    if (!$session->has('id')) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
      die;
    }
    $this->simpanan = new SimpananModel();
    $this->anggota = new AnggotaModel();
    $this->total = new SimpananTotalModel();
    $this->penarikan = new PenarikanModel();
  }

  public function index()
	{
		return view('admin/simpanan/data_simpanan', [
      'simpanan' => $this->simpanan->getSimpanan(),
      'basic' => new LibBasic()
    ]);
	}

  public function penarikan()
	{
		return view('admin/penarikan/data_penarikan', [
      'data' => $this->penarikan->getPenarikan()->findAll()
    ]);
	}

  public function tambah()
  {
    return view('admin/simpanan/tambah_simpanan', [
      'anggota' => $this->anggota->where('role','anggota')->find(),
      'validation' => \Config\Services::validation()
    ]);
  }

  public function tambahPenarikan()
  {
    return view('admin/penarikan/tambah_penarikan', [
      'anggota' => $this->anggota->where('role','anggota')->find(),
      'validation' => \Config\Services::validation()
    ]);
  }

  public function edit($id='')
  {
    return view('admin/simpanan/edit_simpanan', [
      'data' => $this->simpanan->getSimpanan($id),
      'anggota' => $this->anggota->where('role','anggota')->find(),
      'validation' => \Config\Services::validation()
    ]);
  }

  public function save()
  {
    //validate
    if (!$this->validate([
      'nik' => ['label' => 'NIK', 'rules' => 'required'],
      'jenis' => ['label' => 'Jenis', 'rules' => 'required'],
      'tgl' => ['label' => 'Tanggal', 'rules' => 'required'],
      'jml' => ['label' => 'Jumlah Uang', 'rules' => 'required'],
    ])) {
      return redirect()->to('/kas/tambah')->withInput();
    }

    $this->simpanan->save([
      'nik' => $this->request->getPost('nik'),
      'jenis' => $this->request->getPost('jenis'),
      'tgl_simpan' => $this->request->getPost('tgl'),
      'jumlah' => $this->request->getPost('jml'),
      'keterangan' => $this->request->getPost('keterangan'),
    ]);

    $this->total->update($this->request->getPost('nik'), 
      [
        'total_simpan' => $this->total->find($this->request->getPost('nik'))['total_simpan'] + $this->request->getPost('jml')
      ]);

    return redirect()->to('/simpanan');
  }

  public function savePenarikan()
  {
    //validate
    if (!$this->validate([
      'nik' => ['label' => 'NIK', 'rules' => 'required'],
      'jumlah' => ['label' => 'Jenis', 'rules' => 'required'],
      'tgl' => ['label' => 'Tanggal', 'rules' => 'required'],
    ])) {
      return redirect()->to('/kas/tambah')->withInput();
    }

    $this->penarikan->save([
      'nik' => $this->request->getPost('nik'),
      'tgl_trans' => $this->request->getPost('tgl'),
      'jumlah' => $this->request->getPost('jumlah'),
    ]);

    $this->total->update($this->request->getPost('nik'), 
      [
        'total_simpan' => $this->total->find($this->request->getPost('nik'))['total_simpan'] - $this->request->getPost('jumlah')
      ]);

    return redirect()->to('/penarikan');
  }
  
  public function update()
  {
    //validate
    if (!$this->validate([
      'nik' => ['label' => 'NIK', 'rules' => 'required'],
      'jenis' => ['label' => 'Jenis', 'rules' => 'required'],
      'tgl' => ['label' => 'Tanggal', 'rules' => 'required'],
      'jml' => ['label' => 'Jumlah Uang', 'rules' => 'required'],
      ])) {
        return redirect()->to('/kas/tambah')->withInput();
      }
      
      $this->simpanan->update($this->request->getPost('id'), [
        'nik' => $this->request->getPost('nik'),
        'jenis' => $this->request->getPost('jenis'),
        'tgl_simpan' => $this->request->getPost('tgl'),
        'jumlah' => $this->request->getPost('jml'),
        'keterangan' => $this->request->getPost('keterangan'),
      ]);
    return redirect()->to('/simpanan');
  }

  public function delete($id='')
  {
    $this->simpanan->delete($id);
    return redirect()->to('/simpanan');
  }

}