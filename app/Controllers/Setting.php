<?php 

namespace App\Controllers;

use App\Models\SettingModel;
use App\Controllers\BaseController;


class Setting extends BaseController
{

  public function __construct()
  {
    $session = \Config\Services::session();
    if (!$session->has('id')) {
      throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
      die;
    }
    $this->setting = new SettingModel();
  }

  public function index()
	{
		return view('admin/setting/regulasi', [
      'data' => $this->setting->find(),
      'validation' => \Config\Services::validation()
    ]);
	}

  public function update()
  {
    $this->setting->update(1, [
      'value' => $this->request->getPost('bunga')
    ]);
    $this->setting->update(2, [
      'value' => $this->request->getPost('pokok')
    ]);

    $this->session->setFlashdata('error-status', 'success');
    $this->session->setFlashdata('error-message', 'Pengaturan berhasil diubah');
    return redirect()->to('/setting');
  }

  
}