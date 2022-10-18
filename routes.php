<?php

$routes = [
    '/result' => [ \Src\Actions\Game::class, 'result'],
    'api/turn' => [ \Src\Actions\Game::class, 'turn'],

    '/' => [ \Src\Actions\Game::class, 'index'],
    '/api/play' => [ \Src\Actions\Game::class, 'play'],
    '/api/reset' => [ \Src\Actions\Game::class, 'reset'],
    '/register' => [ \Src\Actions\Game::class, 'register'],
];