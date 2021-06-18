<?php

namespace App\Libraries;

class LibBasic {

    public function hitungBunga($jumlah,$bunga,$lama, $bulan=false)
    {
        $p = (int)$jumlah;
        $i = $bunga / 100;
        $t = (int)$lama;
        $angsurantotal = 0;
        $angsuranpokok = round($p / $t, 2);

        if (!$bulan)
        {
            for ($j=1; $j <= $t; $j++) 
            {
                $bungabulan = round(($p - (($j - 1) * $angsuranpokok)) * $i / 12, 2);
                $totalangsuran = $angsuranpokok + $bungabulan;
                $angsurantotal += $totalangsuran;
            }
        }
        else
        {
            $bungabulan = round(($p - (($bulan - 1) * $angsuranpokok)) * $i / 12, 2);
            $angsurantotal = $angsuranpokok + $bungabulan;
        }
        return $angsurantotal;

    }

    public function myDate($date)
    {
        $tgl = explode('-', $date);
        return $tgl[2]. '-'. $tgl[1]. '-'. $tgl[0];
    }

}