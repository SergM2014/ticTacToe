<?php

$routes = [
    '/' =>  [ \Src\Actions\Game::class, 'start'],
    '/register' => [ \Src\Actions\Game::class, 'register'],
    '/play' => [ \Src\Actions\Game::class, 'play'],
    '/result' => [ \Src\Actions\Game::class, 'result'],
    'api/turn' => [ \Src\Actions\Game::class, 'turn'],

    '/index' => [ \Src\Actions\Game::class, 'index'],
];