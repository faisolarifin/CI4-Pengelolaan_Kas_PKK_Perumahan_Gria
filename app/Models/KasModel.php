<?php
namespace App\Models;

use CodeIgniter\Model;

class KasModel extends Model
{
  protected $table      = 'kas';
  protected $primaryKey = 'id_kas';
  protected $useTimestamps = false;
  protected $allowedFields = ['id_saldo', 'tipe', 'tgl', 'jml_uang', 'keterangan'];

  public function getKas($id = false) {

    if (!$id) {
      return $this->findAll();
    }
    return $this->where(['id_kas' => $id])->first();
  }

}