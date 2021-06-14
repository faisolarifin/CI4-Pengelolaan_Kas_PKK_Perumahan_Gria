<?php 

namespace App\Controllers;

use App\Models\KasModel;
use App\Models\SaldoKasModel;
use App\Libraries\LibBasic;
use App\Controllers\BaseController;


class Kas extends BaseController
{

  public function __construct()
  {
    // $session = \Config\Services::session();
    // if (!$session->has('id')) {
    //   throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    //   die;
    // }
    $this->kas = new KasModel();
    $this->saldo = new SaldoKasModel();
    $this->basic = new LibBasic();
  }

  public function index($id='')
	{
		return view('admin/kas/data_kas', [
      'kas' => $id ? $this->kas->where('id_saldo', $id)->findAll() : $this->kas->findAll(),
      'periode' => $this->saldo->findAll(),
      'basic' => $this->basic,
      'request' => \Config\Services::request()
    ]);
	}

  public function tambah()
  {
    return view('admin/kas/tambah_kas', [
      'data' => $this->saldo->find(),
      'validation' => \Config\Services::validation()
      ]);
    }
    
  public function edit($id='')
    {
      return view('admin/kas/edit_kas', [
      'data' => $this->kas->getKas($id),
      'periode' => $this->saldo->find(),
      'validation' => \Config\Services::validation()
    ]);
  }

  public function save()
  {
    //validate
    if (!$this->validate([
      'periode' => ['label' => 'Periode', 'rules' => 'required'],
      'tipe' => ['label' => 'Tipe', 'rules' => 'required'],
      'tgl' => ['label' => 'Tanggal', 'rules' => 'required'],
      'jml' => ['label' => 'Jumlah Uang', 'rules' => 'required'],
      'keterangan' => ['nama' => 'Keterangan', 'rules' => 'required'],
    ])) {
      return redirect()->to('/kas/tambah')->withInput();
    }

    $saldo = $this->saldo->find($this->request->getPost('periode'))['jumlah'];

    if ($this->request->getPost('tipe') == 'debit') $saldo += $this->request->getPost('jml');
    else if ($this->request->getPost('tipe') == 'kredit') $saldo -= $this->request->getPost('jml');


    $this->saldo->update($this->request->getPost('periode'), [
      'jumlah' => $saldo 
    ]);

    $this->kas->save([
      'id_saldo' => $this->request->getPost('periode'),
      'tipe' => $this->request->getPost('tipe'),
      'tgl' => $this->request->getPost('tgl'),
      'jml_uang' => $this->request->getPost('jml'),
      'keterangan' => $this->request->getPost('keterangan'),
    ]);

    return redirect()->to('/kas');
  }

  public function update()
  {
    //validate
    if (!$this->validate([
      'tipe' => ['label' => 'Tipe', 'rules' => 'required'],
      'tgl' => ['label' => 'Tanggal', 'rules' => 'required'],
      'jml' => ['label' => 'Jumlah Uang', 'rules' => 'required'],
      'keterangan' => ['nama' => 'Keterangan', 'rules' => 'required'],
    ])) {
      return redirect()->to("/kas/{$this->request->getPost('id')}/edit")->withInput();
    }

    $periode = $this->kas->find($this->request->getPost('id'));
    if ($periode['id_saldo'] != $this->request->getPost('periode'))
    {
      $kembalikan_saldo = 0;
      $periode_lama = $this->saldo->find($periode['id_saldo']);
      $periode_update = $this->saldo->find($this->request->getPost('periode'));
      if ($periode['tipe'] == 'debit')
      {
        $kembalikan_saldo = $periode_lama['jumlah'] - $periode['jml_uang'];
        $this->saldo->update($periode['id_saldo'], [
          'jumlah' => $kembalikan_saldo
        ]);
        $this->saldo->update($this->request->getPost('periode'), [
          'jumlah' => $periode_update['jumlah'] + $periode['jml_uang']
        ]);
      }
      else if ($periode['tipe'] == 'kredit')
      {
        $kembalikan_saldo = $periode_lama['jumlah'] + $periode['jml_uang'];
        $this->saldo->update($periode['id_saldo'], [
          'jumlah' => $kembalikan_saldo
        ]);
        $this->saldo->update($this->request->getPost('periode'), [
          'jumlah' => $periode_update['jumlah'] - $periode['jml_uang']
        ]);
      }
    }

    if ($periode['tipe'] != $this->request->getPost('tipe'))
    {
      $saldo = $this->saldo->find($this->request->getPost('periode'))['jumlah'];

      if ($this->request->getPost('tipe') == 'debit') $saldo += $this->request->getPost('jml');
      else if ($this->request->getPost('tipe') == 'kredit') $saldo -= $this->request->getPost('jml');


      $this->saldo->update($this->request->getPost('periode'), [
        'jumlah' => $saldo 
      ]);
    }

    $this->kas->update($this->request->getPost('id'), [
      'id_saldo' => $this->request->getPost('periode'),
      'tipe' => $this->request->getPost('tipe'),
      'tgl' => $this->request->getPost('tgl'),
      'jml_uang' => $this->request->getPost('jml'),
      'keterangan' => $this->request->getPost('keterangan'),
    ]);

    return redirect()->to('/kas');
  }

  public function delete($id='')
  {
    $periode = $this->kas->find($id);
    if ($periode)
    {
      $kembalikan_saldo = 0;
      $periode_lama = $this->saldo->find($periode['id_saldo']);
      if ($periode['tipe'] == 'debit')
      {
        $kembalikan_saldo = $periode_lama['jumlah'] - $periode['jml_uang'];
        $this->saldo->update($periode['id_saldo'], [
          'jumlah' => $kembalikan_saldo
        ]);
      }
      else if ($periode['tipe'] == 'kredit')
      {
        $kembalikan_saldo = $periode_lama['jumlah'] + $periode['jml_uang'];
        $this->saldo->update($periode['id_saldo'], [
          'jumlah' => $kembalikan_saldo
        ]);
      }
    }
    $this->kas->delete($id);
    return redirect()->to('/kas');
  }

}