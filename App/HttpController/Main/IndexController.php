<?php


namespace App\HttpController\Main;
use App\Model\UserModel;
use EasySwoole\Http\AbstractInterface\Controller;
use EasySwoole\Mysqli\Mysqli;
use Swoole\Coroutine;


class IndexController extends Controller
{
    public function index()
    {
        $this->response()->write('easyswoole');
        $this->writeJson(200, ['json']);
    }


    public function add()
    {
        $data = [
            'name' => 'es',
            'phone' => '10086'
        ];
        $conf = new \EasySwoole\Mysqli\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
        $db = new Mysqli($conf);
        $user = new UserModel($db);
        $res = $user->create($data);
        return $this->writeJson(200, $res);
    }

    //协程插入数据 模拟耗时操作
    public function coAdd()
    {
        $conf = new \EasySwoole\Mysqli\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
        $data = [
            'name' => 'coroutine',
            'phone' => '10086'
        ];

        go(function () use ($conf, $data){
            Coroutine::sleep(5);
            $db = new Mysqli($conf);
            $user = new UserModel($db);
            $user->create($data);
            echo "111";
        });

        go(function () use ($conf, $data) {
            Coroutine::sleep(5);
            $db = new Mysqli($conf);
            $user = new UserModel($db);
            $user->create($data);
            echo "222";
        });

        return $this->writeJson(200, 'doing');
    }

    //传统模式
    public function classicAdd()
    {
        $conf = new \EasySwoole\Mysqli\Config(\EasySwoole\EasySwoole\Config::getInstance()->getConf('MYSQL'));
        $data = [
            'name' => 'coroutine',
            'phone' => '10086'
        ];
        $db = new Mysqli($conf);
        sleep(5);
        $user = new UserModel($db);
        $user->create($data);

        sleep(5);
        $user = new UserModel($db);
        $user->create($data);
        return $this->writeJson(200, 'finish');

    }







}