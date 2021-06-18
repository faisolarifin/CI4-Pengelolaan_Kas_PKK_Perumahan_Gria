<?php
namespace App\Models;

use CodeIgniter\Model;

class AngsuranModel extends Model
{
  protected $table      = 'trans_angsuran';
  protected $primaryKey = 'id_angsur';
  protected $useTimestamps = false;
  protected $allowedFields = ['id_pinjam', 'nik', 'tanggal', 'angsuran_ke', 'jumlah'];

  public function getAngsuran() 
  {
    $this->join('users', 'users.nik = trans_angsuran.nik', 'LEFT');
    $this->select('users.nik, nama');
    $this->select('trans_angsuran.*');
    $this->where(['users.role !=' => 'admin']);
    return $this;
  }

}