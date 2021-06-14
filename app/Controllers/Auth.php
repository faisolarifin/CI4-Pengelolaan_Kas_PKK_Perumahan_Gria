<?php

namespace App\Controllers;

use \App\Models\AnggotaModel;

class Auth extends BaseController
{
  protected $user;

  public function __construct()
  {
    $this->user = new AnggotaModel();
  }

  public function index()
	{
		return view('auth', [
		  'validation' => \Config\Services::validation()
    ]);
	}

	public function auth()
  {
    if (!$this->validate([
      'username' => 'required',
      'password' => 'required'
    ])) {
      return redirect()->to('/auth')->withInput();
    }

    $user = $this->request->getPost('username');
    $pass = $this->request->getPost('password');
    $auth = $this->user->where('username', $user)->first();
    if ($auth):
      if ($auth['password'] == ($pass)):
        $this->session->set([
          'id' => $auth['nik'],
          'nama' => $auth['nama'],
          'role' => $auth['role']
        ]);
        return redirect()->to('/home');
      else:
        $this->session->setFlashdata('error', 'Password yang anda masukkan salah !');
        return redirect()->to('/auth')->withInput();
      endif;
    else:
      $this->session->setFlashdata('error', 'Username tidak ditemukan !');
      return redirect()->to('/auth')->withInput();
    endif;
  }

  public function logout() {
    $this->session->destroy();
    return redirect()->to('/auth');
  }


	//--------------------------------------------------------------------

}
