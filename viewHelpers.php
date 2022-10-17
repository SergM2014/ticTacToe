<?php

function view($view) {
    include_once ($_SERVER['DOCUMENT_ROOT'].'/../resources/view/'.$view);
}

function currentPlayer() {
    return playerName(getTurn());
}

function playerName($player='x') {
    return $_SESSION['PLAYER_' . strtoupper($player) . '_NAME'];

}

function getTurn() {
    return $_SESSION['TURN'] ? $_SESSION['TURN'] : 'x';
}

function getCell($cell='') {
    return $_SESSION['CELL_' . $cell];
}

function score($player='x') {
    $score = $_SESSION['PLAYER_' . strtoupper($player) . '_WINS'];
    return $score ? $score : 0;
}