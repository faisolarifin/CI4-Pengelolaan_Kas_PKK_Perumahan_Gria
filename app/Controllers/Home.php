<?php

namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\SimpananTotalModel;

class Home extends BaseController
{
	public function index()
	{
		return view('admin/dashboard', [
			'anggota' => (new AnggotaModel())->countAllResults(),
			'simpan' => (new SimpananTotalModel())->selectSum('total_simpan')->find()[0]['total_simpan']
		]);
	}
	
}
