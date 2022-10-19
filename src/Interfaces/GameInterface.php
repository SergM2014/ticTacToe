<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface GameInterface
{        
    /**
     * index
     *
     * @return mixed
     */
    public function index(): mixed;
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
    public function reset(): mixed;
    
    /**
     * turn
     *
     * @return void
     */
    public function turn(): void;
}