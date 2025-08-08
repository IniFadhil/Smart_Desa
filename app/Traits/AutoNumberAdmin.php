<?php

namespace App\Traits;

use DB;

trait AutoNumberAdmin
{
    public function generateAutoNumberAdmin($role_id, $desa_id)
    {

        $cekId = DB::table('ds_admins')->select(DB::raw('max(id) as id'))->where('id', 'like', '%' . $desa_id . $role_id . '%')->first();

        if (empty($cekId->id)) {
            return $desa_id . '' . $role_id . '001';
        } else {
            $lastId = (int) substr($cekId->id, 13, 4);
            $no = $lastId + 1;
            $NewID = $desa_id . '' . $role_id . sprintf('%03s', $no);
            return $NewID;
        }
    }
}