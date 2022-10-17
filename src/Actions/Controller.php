<?php

declare(strict_types=1);

namespace Src\Actions;

class Controller 
{    
    /**
     * playersRegistered
     *
     * @return bool
     */
    public function playersRegistered(): bool
    {
         return @$_SESSION['PLAYER_X_NAME'] && @$_SESSION['PLAYER_O_NAME'];
    }
}