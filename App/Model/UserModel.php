<?php


namespace App\Model;


class UserModel extends BaseModel
{
    protected $tableName = 'users';
    protected $pk = 'id';

    public function create(array $data)
    {
       $res = $this->db()->insert($this->tableName,$data);
       return $res;
    }

}