<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface GameActionInterface
{        
    /**
     * index
     *
     * @return mixed
     */
    public function index(): mixed;
  
    /**
     * result
     *
     * @return mixed
     */
    public function reset(): void;
    
    /**
     * turn
     *
     * @return void
     */
    public function turn(): void;
    
    /**
     * init
     *
     * @return void
     */
     public function init(): void;
}