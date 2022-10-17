<?php

declare(strict_types=1);

namespace Src\Interfaces;

interface StorageInterface
{    
    /**
     * get
     *
     * @return void
     */
    public function get(): void;
    
    /**
     * set
     *
     * @return void
     */
    public function set(): void;
}