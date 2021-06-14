<?php 

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\SimpananTotalModel;
use App\Libraries\LibBasic;
use App\Controllers\BaseController;


class Anggota extends BaseController
{

  public function __construct()
  {
    // $session = \Config\Services::session();
    // if (!$session->has('id')) {
    //   throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //   die;
    // }
    $this->anggota = new AnggotaModel();
    $this->total = new SimpananTotalModel();
  }

  public function index()
	{
		return view('admin/anggota/data_anggota', [
      'anggota' => $this->anggota->findAll(),
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
      'nik' => ['label' => 'NIK', 'rules' => 'required'],
      'nama' => ['label' => 'Nama', 'rules' => 'required'],
      'username' => ['label' => 'Username', 'rules' => 'required'],
      'password' => ['label' => 'Password', 'rules' => 'required'],
      'role' => ['nama' => 'Role', 'rules' => 'required'],
    ])) {
      return redirect()->to('/anggota/tambah')->withInput();
    }

    $this->anggota->save([
      'nik' => $this->request->getPost('nik'),
      'nama' => $this->request->getPost('nama'),
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
      'nik' => ['label' => 'NIK', 'rules' => 'required'],
      'nama' => ['label' => 'Nama', 'rules' => 'required'],
      'username' => ['label' => 'Username', 'rules' => 'required'],
      'password' => ['label' => 'Password', 'rules' => 'required'],
      'role' => ['nama' => 'Role', 'rules' => 'required'],
    ])) {
      return redirect()->to("/anggota/{$this->request->getPost('id')}/edit")->withInput();
    }

    $this->anggota->update($this->request->getPost('id'), [
      'nik' => $this->request->getPost('nik'),
      'nama' => $this->request->getPost('nama'),
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

	//--------------------------------------------------------------------

}