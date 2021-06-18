<?php
namespace App\Models;

use CodeIgniter\Model;

class SHUModel extends Model
{
  protected $table      = 'shu';
  protected $primaryKey = 'id_shu';
  protected $useTimestamps = false;
  protected $allowedFields = ['nik', 'tot_simpan', 'jml_shu'];

  public function getDataSHU($id = false) {

      $this->join('users', 'users.nik = shu.nik', 'LEFT');
      $this->select('users.nama, users.alamat');
      $this->select('shu.*');
      $this->where(['users.role !=' => 'admin']);
      return $this;


  }
}