<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface AuthentificationInterface
{    
    /**
     * start
     *
     * @return void
     */
    public function start();
    
    /**
     * register
     *
     * @return void
     */
    public function register();
}