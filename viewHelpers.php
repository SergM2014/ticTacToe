<?php

function view($view) {
    include_once ($_SERVER['DOCUMENT_ROOT'].'/../resources/view/'.$view);
}

function getCell($cell='') 
{
    return $_SESSION['CELL_' . $cell];
}