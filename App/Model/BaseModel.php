<?php


namespace App\Model;

use EasySwoole\Mysqli\Mysqli;

abstract class BaseModel
{
    protected $tableName;
    protected $pk;
    private $db;


    public function __construct(Mysqli $db)
    {
        $this->db = $db;
    }

    protected function db()
    {
        return $this->db;
    }

}