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
      $this->join('users', 'users.nik = pinjam.nik', 'LEFT');
      $this->select('users.nik, nama');
      $this->select('pinjam.*');
      $this->where(['users.role !=' => 'admin']);
      return $this->findAll();
    }
    return $this->where(['id_pinjam' => $id])->first();
  }

}