<?php

declare(strict_types=1);

namespace Src\Models;

use Src\ExceptionHandler;
use Src\Interfaces\StorageInterface;

class Cookie implements StorageInterface
{    
    use ExceptionHandler;
    /**
     * get
     *
     * @return void
     */
    public function get(): void
    {
        try{
            if(isset($_COOKIE['game'])) session_decode($_COOKIE['game']);
            //throw new \Exception();
        }
        catch (\Exception $ex) {
            $this->prozessException($ex->getMessage());
        }
    }
    
    /**
     * set
     *
     * @return void
     */
    public function set(): void
    {
        $value = session_encode();
        //setcookie('game', $value, time()+86400, '/');
        setcookie('game', $value, time()+240, '/');
    }
}