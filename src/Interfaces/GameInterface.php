<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface GameInterface
{    
    /**
     * play
     *
     * @return mixed
     */
    public function play(): mixed;
    
    /**
     * result
     *
     * @return mixed
     */
    public function result(): mixed;
    
    /**
     * turn
     *
     * @return void
     */
    public function turn(): void;
}