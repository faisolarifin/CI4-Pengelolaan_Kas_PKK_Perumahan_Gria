<?php 

namespace App\Controllers;

use App\Models\PinjamanModel;
use App\Libraries\LibBasic;
use App\Controllers\BaseController;


class Pinjaman extends BaseController
{

  public function __construct()
  {
    $session = \Config\Services::session();
    if (!$session->has('id')) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
      die;
    }
    $this->pinjaman = new PinjamanModel();
    $this->basic = new LibBasic();
  }

  public function index()
	{
		return view('admin/pinjaman/data_pinjaman', [
      'data' => $this->pinjaman->getPinjaman(),
      'basic' => $this->basic
    ]);
	}

  public function konfir($id='')
  {
      $this->pinjaman->update($id, [
        'status' => 'pinjam',
      ]);
    return redirect()->to('/pinjaman');
  }

  public function lunas($id='')
  {
      $this->pinjaman->update($id, [
        'status' => 'lunas',
      ]);
    return redirect()->to('/pinjaman');
  }

  public function tolak($id='')
  {
      $this->pinjaman->update($id, [
        'status' => 'tolak',
      ]);
    return redirect()->to('/pinjaman');
  }


}