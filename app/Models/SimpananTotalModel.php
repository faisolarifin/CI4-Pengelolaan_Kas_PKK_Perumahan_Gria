<?php
namespace App\Models;

use CodeIgniter\Model;

class SimpananTotalModel extends Model
{
  protected $table      = 'simpanan';
  protected $primaryKey = 'nik';
  protected $useTimestamps = false;
  protected $useAutoIncrement = false;
  protected $allowedFields = ['nik', 'total_simpan'];

}