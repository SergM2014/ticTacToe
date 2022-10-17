<?php

use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Src\Actions\ErrorOutput;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Src\Interfaces\GameEngineInterface;
use Src\Models\GameEngine;
use Src\Interfaces\StorageInterface;
use Src\Models\Cookie;

return [
    LoggerInterface::class => DI\factory(function () {
        $logger = new Logger('mylog');
        $fileHandler = new StreamHandler(DATA_LOGS, Logger::DEBUG);
        $fileHandler->setFormatter(new LineFormatter());
        $logger->pushHandler($fileHandler);

        return $logger;
    }),
    GameEngineInterface::class => DI\get(GameEngine::class),
    StorageInterface::class => DI\get(Cookie::class),   
];