<?php

$routes = [
    '/' => [ \Src\Actions\Game::class, 'index'],
    'api/init' => [ \Src\Actions\Game::class, 'init'],
    'api/turn' => [ \Src\Actions\Game::class, 'turn'],
    '/api/reset' => [ \Src\Actions\Game::class, 'reset'],
    '/register' => [ \Src\Actions\Game::class, 'register'],
];