<?php
require 'vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Http\Controllers\Frontend\MyChatControllerWebSocket;

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new MyChatControllerWebSocket()
        )
    ),
    8080
);

$server->run();