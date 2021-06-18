<?php
namespace App\Models;

use CodeIgniter\Model;

class SimpananModel extends Model
{
  protected $table      = 'trans_simpan';
  protected $primaryKey = 'id_simpan';
  protected $useTimestamps = false;
  protected $allowedFields = ['nik', 'jenis', 'tgl_simpan', 'jumlah', 'keterangan'];

  public function getSimpanan($id = false) {

    if (!$id) {
      $this->join('users', 'users.nik = trans_simpan.nik', 'LEFT');
      $this->select('users.nik, nama');
      $this->select('trans_simpan.*');
      $this->where(['users.role !=' => 'admin']);
      return $this->findAll();
    }
    return $this->where(['id_simpan' => $id])->first();
  }
}