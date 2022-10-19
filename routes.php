<?php

$routes = [
    '/' => [ \Src\Actions\Game::class, 'index'],
    'api/turn' => [ \Src\Actions\Game::class, 'turn'],
    '/api/play' => [ \Src\Actions\Game::class, 'play'],
    '/api/reset' => [ \Src\Actions\Game::class, 'reset'],
    '/register' => [ \Src\Actions\Game::class, 'register'],
];