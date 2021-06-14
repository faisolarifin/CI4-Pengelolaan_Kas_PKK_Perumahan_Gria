<?php
namespace App\Models;

use CodeIgniter\Model;

class PenarikanModel extends Model
{
  protected $table      = 'trans_penarikan';
  protected $primaryKey = 'id_penarikan';
  protected $useTimestamps = false;
  protected $allowedFields = ['nik', 'tgl_trans', 'jumlah'];

  public function getPenarikan() 
  {
    $this->join('users', 'users.nik = trans_penarikan.nik', 'LEFT');
    $this->select('users.nik, nama');
    $this->select('trans_penarikan.*');
    $this->where(['users.role !=' => 'admin']);
    return $this;
  }

}