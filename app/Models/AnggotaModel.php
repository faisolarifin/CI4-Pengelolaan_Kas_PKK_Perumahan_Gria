<?php
namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
  protected $table      = 'users';
  protected $primaryKey = 'nik';
  protected $useTimestamps = false;
  protected $useAutoIncrement = false;
  protected $allowedFields = ['nik', 'nama', 'username', 'password', 'tgl_registrasi', 'role'];

  public function getAnggota($id = false) {

    if (!$id) {
      return $this->findAll();
    }
    return $this->where(['nik' => $id])->first();
  }

  public function getTotalSimpanan() {
    $this->join('simpanan', 'simpanan.nik = users.nik', 'LEFT');
    $this->select('users.nik, nama, total_simpan');
    $this->where(['users.role !=' => 'admin']);
    return $this;
  }

}