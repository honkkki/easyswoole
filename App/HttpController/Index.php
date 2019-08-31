<?php
namespace App\HttpController;
use EasySwoole\Http\AbstractInterface\Controller;

class Index extends Controller
{
    public function index()
    {
        $this->response()->write("hello easyswoole!");
    }

    public function test()
    {
        //$this->response()->write("test router");
        return $this->writeJson(200,['name'=>'tom']);

    }

}