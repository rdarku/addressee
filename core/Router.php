<?php

namespace App\Core;

class Router
{
    protected array $routes = [
	    'GET' => [],
	    'POST' => []
    ];

    public static function load($file)
    {
        $router = new static();

        try {
            if( is_file(  $file ) ) {
                include_once $file;
            }
            else{
                throw new \Exception( $file . ' not found.' );
            }
        }
        catch (\Exception $e){
            throw new \Exception( $e->getMessage()  );
        }

        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if( array_key_exists($uri, $this->routes[$requestType])){
            return $this->callAction(...explode('@',$this->routes[$requestType][$uri]));
        }

        throw new \Exception("No route defined for this URI [{$uri}]");
    }

    protected function callAction($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;

        if (! method_exists($controller, $action)) {
            throw new \Exception(
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}