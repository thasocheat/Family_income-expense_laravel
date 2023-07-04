<?php

namespace App\Repositories;

use App\Models\ChildRecord;
use App\Models\User;
use App\Models\UserType;
use App\Models\StaffRecord;


class ChildRepo{

    public function getRecord(array $data)
    {
        return $this->activeChild()->where($data)->with('user');
    }

    public function activeChild()
    {
        return ChildRecord::where(['status' => 0]);
    }

    public function createRecord($data)
    {
        return ChildRecord::create($data);
    }

    public function updateRecord($id, array $data)
    {
        return ChildRecord::find($id)->update($data);
    }

    public function update(array $where, array $data)
    {
        return ChildRecord::where($where)->update($data);
    }

}
