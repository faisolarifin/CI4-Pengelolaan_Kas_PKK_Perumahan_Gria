<?php
namespace App\Models;

use CodeIgniter\Model;

class SimpananModel extends Model
{
  protected $table      = 'trans_simpan';
  protected $primaryKey = 'id_simpan';
  protected $useTimestamps = false;
  protected $allowedFields = ['id_user', 'nik', 'jenis', 'tgl_simpan', 'jumlah', 'keterangan'];

  public function getSimpanan($id = false) {

    if (!$id) {
      return $this->findAll();
    }
    return $this->where(['id_simpan' => $id])->first();
  }
}