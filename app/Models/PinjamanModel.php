<?php
namespace App\Models;

use CodeIgniter\Model;

class PinjamanModel extends Model
{
  protected $table      = 'pinjam';
  protected $primaryKey = 'id_pinjam';
  protected $useTimestamps = false;
  protected $allowedFields = ['nik', 'tgl_pinjam', 'jatuh_tempo', 'lama', 'jumlah', 'total_bayar', 'sisa', 'status'];

  public function getPinjaman($id = false) {

    if (!$id) {
      return $this->findAll();
    }
    return $this->where(['id_pinjam' => $id])->first();
  }

}