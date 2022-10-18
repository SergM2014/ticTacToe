<?php

function view($view) {
    include_once ($_SERVER['DOCUMENT_ROOT'].'/../resources/view/'.$view);
}

function getCell($cell='') 
{
    return $_SESSION['CELL_' . $cell];
}

function playersRegistered()
    {
         return @$_SESSION['PLAYER_X_NAME'] && @$_SESSION['PLAYER_O_NAME'];
    }