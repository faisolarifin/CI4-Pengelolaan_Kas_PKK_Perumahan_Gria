<?php 

namespace App\Controllers;

use App\Models\SaldoKasModel;
use App\Controllers\BaseController;


class SaldoKas extends BaseController
{

  public function __construct()
  {
    $session = \Config\Services::session();
    if (!$session->has('id')) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
      die;
    }
    $this->saldo = new SaldoKasModel();
  }

  public function index()
	{
		return view('admin/saldokas/data_saldokas', [
      'data' => $this->saldo->getSaldoKas()->getResultArray()
    ]);
	}

  public function tambah()
  {
    return view('admin/saldokas/tambah_saldokas', [
      'validation' => \Config\Services::validation()
    ]);
  }

  public function edit($id='')
  {
    return view('admin/saldokas/edit_saldokas', [
      'data' => $this->saldo->find($id),
      'validation' => \Config\Services::validation()
    ]);
  }

  public function save()
  {
    //validate
    if (!$this->validate([
      'bulan' => ['label' => 'Bulan', 'rules' => 'required'],
      'tahun' => ['label' => 'Tahun', 'rules' => 'required'],
      'jumlah' => ['label' => 'Jumlah Saldo', 'rules' => 'required'],
    ])) {
      return redirect()->to('/saldokas/tambah')->withInput();
    }

    $this->saldo->save([
      'bulan' => $this->request->getPost('bulan'),
      'tahun' => $this->request->getPost('tahun'),
      'jumlah' => $this->request->getPost('jumlah'),
    ]);

    return redirect()->to('/saldokas');
  }
  
  public function update()
  {
    //validate
    if (!$this->validate([
      'bulan' => ['label' => 'Bulan', 'rules' => 'required'],
      'tahun' => ['label' => 'Tahun', 'rules' => 'required'],
      'jumlah' => ['label' => 'Jumlah Saldo', 'rules' => 'required'],
    ])) {
      return redirect()->to("/saldokas/{$this->request->getPost('id')}/tambah")->withInput();
    }

    $this->saldo->update($this->request->getPost('id'), [
      'bulan' => $this->request->getPost('bulan'),
      'tahun' => $this->request->getPost('tahun'),
      'jumlah' => $this->request->getPost('jumlah'),
    ]);

    return redirect()->to('/saldokas');
  }

  public function delete($id='')
  {
    $this->saldo->delete($id);
    return redirect()->to('/saldokas');
  }

}