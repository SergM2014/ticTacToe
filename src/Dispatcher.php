<?php

declare(strict_types=1);

namespace Src;

use DI\ContainerBuilder;

class Dispatcher
{
    public function __construct(private array $routes) {}
    
    /**
     * run
     *
     * @return void
     */
    public function run(): void
    {
        $contr = $this->getRoutingFromUrl();

        $builder = new ContainerBuilder();
        $builder->addDefinitions($_SERVER['DOCUMENT_ROOT'].'/../DiSettings.php');
        $container = $builder->build();
 
        $myClass = $container->get($contr[0]);
      
        $method = $contr[1];
        $myClass->$method();
    }
        
    /**
     * getRoutingFromUrl
     *
     * @return array
     */
    private function getRoutingFromUrl(): array
    {
    
        $keys = array_keys($this->routes);
        
        for($i = 0; $i < count($keys); $i++){
            $keys[$i] = trim($keys[$i], '/');
        }

        $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        if($uriSegments[1] == 'api') {
            $uri = implode('/',[$uriSegments[1], $uriSegments[2]]);
        } else {
            $uri = $uriSegments[1];
        }

        $key = array_search($uri, $keys);

        if ($key === false) return NOT_FOUND_ROUTE;

        $array = array_values($this->routes);

        return $array[$key];
    }
}
