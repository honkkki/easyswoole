<?php
namespace App\WebSocket;

use EasySwoole\Component\Timer;
use EasySwoole\EasySwoole\ServerManager;
use EasySwoole\EasySwoole\Swoole\Task\TaskManager;
use EasySwoole\Socket\AbstractInterface\Controller;

/**
 * Class Index
 *
 * 此类是默认的 websocket 消息解析后访问的 控制器
 *
 * @package App\WebSocket
 */
class Index extends Controller
{
    function hello()
    {
        Timer::getInstance()->loop(2000, function () {
            echo "2秒跑一次！";
        });
        $client = $this->caller()->getClient();
        $this->response()->setMessage('call hello with arg:'. json_encode($this->caller()->getArgs()));
        $server = ServerManager::getInstance()->getSwooleServer();
        $server->push($client->getFd(),'come from push');
    }

    public function who()
    {
        $this->response()->setMessage('编号为： '. $this->caller()->getClient()->getFd());
    }

    function delay()
    {
        $this->response()->setMessage('this is delay action');
        $client = $this->caller()->getClient();

        // 异步推送, 这里直接 use fd也是可以的
        TaskManager::async(function () use ($client){
            $server = ServerManager::getInstance()->getSwooleServer();
            $i = 0;
            while ($i < 5) {
                sleep(1);
                $server->push($client->getFd(),'push in http at '. date('H:i:s'));
                $i++;
            }
        });
    }
}