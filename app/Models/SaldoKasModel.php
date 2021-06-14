<?php
namespace App\Models;

use CodeIgniter\Model;

class SaldoKasModel extends Model
{
  protected $table      = 'saldo_kas';
  protected $primaryKey = 'id_saldo';
  protected $useTimestamps = false;
  protected $allowedFields = ['id_saldo', 'bulan', 'tahun', 'jumlah'];

  public function getSaldoKas()
  {
    return $this->query("SELECT a.*, (select sum(jml_uang) from kas where tipe='kredit' and id_saldo=a.id_saldo) kredit, (select sum(jml_uang) from kas where tipe='debit' and id_saldo=a.id_saldo) debit from saldo_kas a");
  }

}