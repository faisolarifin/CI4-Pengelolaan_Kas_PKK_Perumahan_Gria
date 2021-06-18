<?php 

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\SimpananTotalModel;
use App\Models\SHUModel;
use App\Libraries\LibBasic;
use App\Controllers\BaseController;


class Anggota extends BaseController
{

  public function __construct()
  {
    $session = \Config\Services::session();
    if (!$session->has('id')) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
      die;
    }
    $this->anggota = new AnggotaModel();
    $this->total = new SimpananTotalModel();
    $this->shu = new SHUModel();
  }

  public function index()
	{
		return view('admin/anggota/data_anggota', [
      'anggota' => $this->anggota->orderBy('role', 'desc')->findAll(),
      'basic' => new LibBasic()
    ]);
	}

  public function tambah()
  {
    return view('admin/anggota/tambah_anggota', [
      'validation' => \Config\Services::validation()
    ]);
  }

  public function edit($id='')
  {
    return view('admin/anggota/edit_anggota', [
      'data' => $this->anggota->getAnggota($id),
      'validation' => \Config\Services::validation()
    ]);
  }

  public function save()
  {
    //validate
    if (!$this->validate([
      'nik' => ['label' => 'NIK', 'rules' => 'required|integer|max_length[16]|min_length[16]|is_unique[users.nik]'],
      'nama' => ['label' => 'Nama', 'rules' => 'required|alpha_space'],
      'telp' => ['label' => 'Telp', 'rules' => 'required|integer'],
      'alamat' => ['label' => 'Alamat', 'rules' => 'required'],
      'username' => ['label' => 'Username', 'rules' => 'required'],
      'password' => ['label' => 'Password', 'rules' => 'required'],
      'role' => ['nama' => 'Role', 'rules' => 'required'],
    ])) {
      return redirect()->to('/anggota/tambah')->withInput();
    }

    $this->anggota->save([
      'nik' => $this->request->getPost('nik'),
      'nama' => $this->request->getPost('nama'),
      'telp' => $this->request->getPost('telp'),
      'alamat' => $this->request->getPost('alamat'),
      'tgl_registrasi' => date('Y-m-d'),
      'username' => $this->request->getPost('username'),
      'password' => $this->request->getPost('password'),
      'role' => $this->request->getPost('role'),
    ]);

    $this->total->save([
      'nik' => $this->request->getPost('nik'),
      'total_simpan' => 0,
    ]);

    return redirect()->to('/anggota');
  }

  public function update()
  {
     //validate
    if (!$this->validate([
      'nik' => ['label' => 'NIK', 'rules' => 'required|integer|max_length[16]|min_length[16]'],
      'nama' => ['label' => 'Nama', 'rules' => 'required|alpha_space'],
      'telp' => ['label' => 'Telp', 'rules' => 'required|integer'],
      'alamat' => ['label' => 'Alamat', 'rules' => 'required'],
      'username' => ['label' => 'Username', 'rules' => 'required'],
      'password' => ['label' => 'Password', 'rules' => 'required'],
      'role' => ['nama' => 'Role', 'rules' => 'required'],
    ])) {
      return redirect()->to("/anggota/{$this->request->getPost('id')}/edit")->withInput();
    }

    $this->anggota->update($this->request->getPost('id'), [
      'nik' => $this->request->getPost('nik'),
      'nama' => $this->request->getPost('nama'),
      'telp' => $this->request->getPost('telp'),
      'alamat' => $this->request->getPost('alamat'),
      'username' => $this->request->getPost('username'),
      'password' => $this->request->getPost('password'),
      'role' => $this->request->getPost('role'),
    ]);

    return redirect()->to('/anggota');
  }

  public function delete($id='')
  {
    $this->anggota->delete($id);
    return redirect()->to('/anggota');
  }

  public function totsimpan()
  {
    return view('admin/totsimpan/total_simpan', [
      'data' => $this->anggota->getTotalSimpanan()->findAll(),
    ]);
  }

  public function shu()
  {
    return view('admin/shu/pembagian_shu', [
      'data' => $this->shu->getDataSHU()->findAll(),
    ]);
  }
  public function reset()
  {
    $this->shu->truncate();
    $this->session->setFlashdata('error-status', 'success');
    $this->session->setFlashdata('error-message', 'SHU berhasil direset');
    return redirect()->to('/shu');
  }

  public function bagi_shu()
  {
    if ($this->shu->countAllResults() <= 0) 
    {
      $shu = $this->request->getPost('jumlah');
      $jasamodal = $this->request->getPost('jasamodal');
      $total_simpanan = $this->total->selectSum('total_simpan')->find()[0]['total_simpan'];
      $data=$this->anggota->getTotalSimpanan()->find();
      foreach($data as $row) 
      {
        $SHUa = round(($row['total_simpan'] / $total_simpanan) * ($jasamodal/100) * $shu, 0);
        $this->shu->save([
          'nik' => $row['nik'],
          'tot_simpan' => $row['total_simpan'],
          'jml_shu' => $SHUa,
        ]);
      }

      $this->session->setFlashdata('error-status', 'success');
      $this->session->setFlashdata('error-message', 'SHU berhasil dibagikan');
      return redirect()->to('/shu');
    }
  }

	//--------------------------------------------------------------------

}