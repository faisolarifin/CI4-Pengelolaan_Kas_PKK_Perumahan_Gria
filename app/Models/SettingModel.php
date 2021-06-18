<?php
namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
  protected $table      = 'setting';
  protected $primaryKey = 'id';
  protected $useTimestamps = false;
  protected $allowedFields = ['nama', 'value'];


}