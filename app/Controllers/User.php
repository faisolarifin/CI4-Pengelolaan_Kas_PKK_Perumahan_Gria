<?php 

namespace App\Controllers;

use App\Models\KasModel;
use App\Models\PinjamanModel;
use App\Libraries\LibBasic;
use App\Models\AnggotaModel;
use App\Models\SaldoKasModel;
use App\Models\SettingModel;
use App\Models\SimpananTotalModel;
use App\Controllers\BaseController;


class User extends BaseController
{

  public function __construct()
  {
    $session = \Config\Services::session();
    if (!$session->has('id')) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
      die;
    }
    $this->kas = new kasModel();
    $this->pinjaman = new PinjamanModel();
    $this->saldo = new SaldoKasModel();
    $this->setting = new SettingModel();
    $this->basic = new LibBasic();
  }

  public function index()
	{
		return view('user/dashboard', [
      'anggota' => (new AnggotaModel())->countAllResults(),
			'simpan' => (new SimpananTotalModel())->selectSum('total_simpan')->where('nik', $this->session->id)->find()[0]['total_simpan']
    ]);
	}

  public function kas($id='')
	{
		return view('user/kas', [
      'kas' => $id ? $this->kas->where('id_saldo', $id)->findAll() : $this->kas->findAll(),
      'basic' => $this->basic,
      'periode' => $this->saldo->find(),
      'request' => \Config\Services::request()
    ]);
	}

  public function pinjaman()
	{
		return view('user/pinjaman', [
      'basic' => $this->basic,
      'data' => $this->pinjaman->where('nik', $this->session->id)->findAll()
    ]);
	}

  public function pinjam()
	{
		return view('user/pinjam_form', [
      'validation' => \Config\Services::validation(),
      'bunga' => $this->setting->find(1)['value']
    ]);
	}

  public function ajukanPinjaman()
  {
    //validate
    if (!$this->validate([
      'tgl' => ['label' => 'Tanggal', 'rules' => 'required'],
      'jml' => ['label' => 'Jumlah Uang', 'rules' => 'required|decimal'],
      'lama' => ['label' => 'Lama Pinjam', 'rules' => 'required|decimal'],
    ])) {
      return redirect()->to('/pinjam')->withInput();
    }

    if ($this->pinjaman->where(['nik' => $this->session->id,
      'status' => 'pending'
    ])->countAllResults() < 1)
    {
      if ($this->pinjaman->where(['nik' => $this->session->id,
        'status' => 'pinjam'
      ])->countAllResults() < 1) {
      
        $tgl = $this->request->getPost('tgl');
        $lama = $this->request->getPost('lama');

        $total = $this->basic->hitungBunga($this->request->getPost('jml'), $this->setting->find(1)['value'], $lama);

        $this->pinjaman->save([
          'nik' => $this->session->id,
          'tgl_pinjam' => $tgl,
          'jatuh_tempo' => date('Y-m-d H:i:s', strtotime($tgl. " + $lama day")),
          'lama' => $lama,
          'jumlah' => $this->request->getPost('jml'),
          'total_bayar' => $total,
          'sisa' => $total,
          'status' => 'pending',
        ]);

        $this->session->setFlashdata('error-status', 'success');
        $this->session->setFlashdata('error-message', 'Pinjaman sedang diajukan');
        return redirect()->to('/pinjaman');
      }
      else {
        $this->session->setFlashdata('error-status', 'error');
        $this->session->setFlashdata('error-message', 'Pinjaman anda sebelumnya belum lunas');
        return redirect()->to('/pinjaman');
      }
    }
    else {
      $this->session->setFlashdata('error-status', 'error');
      $this->session->setFlashdata('error-message', 'Anda sudah mengajukan pinjaman');
      return redirect()->to('/pinjaman');
    }
  }
  
  public function dropPinjaman($id)
  {
    $this->pinjaman->where('nik', $this->session->id)->delete($id);
    $this->session->setFlashdata('error-status', 'success');
    $this->session->setFlashdata('error-message', 'Pinjaman berhasil dihapus');
    return redirect()->to('/pinjaman');
  }

  public function saldokas()
	{
		return view('user/saldokas', [
      'data' => $this->saldo->getSaldoKas()->getResultArray(),
    ]);
	}
	

}