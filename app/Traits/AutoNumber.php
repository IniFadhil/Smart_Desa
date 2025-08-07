<?php

namespace App\Traits;

use DB;
use Session;

trait AutoNumber
{
    public function generateAutoNumber($tabel)
    {
        $today = date('Ymd');
        $desa_id = substr(Session::get('desa_id'), 8);
        $cekId = DB::table($tabel)->select(DB::raw('max(id) as id'))->where('id', 'like', '%' . $today . $desa_id . '%')->first();
        if (empty($cekId->id)) {
            return $today . $desa_id . '0001';
        } else {
            $lastId = (int) substr($cekId->id, 12, 5);
            $no = $lastId + 1;
            $NewID = $today . $desa_id . sprintf('%04s', $no);
            return $NewID;
        }
    }
}