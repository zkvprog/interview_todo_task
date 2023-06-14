<?php

namespace App\Core;

use App\Exceptions\ApplicationException;
use App\Core\Route;

class Router
{
    private array $routes = [];

    public function get(string $path, array $callback)
    {
        $this->addRoute('get', $path, $callback);
    }

    public function post(string $path, array $callback)
    {
        $this->addRoute('post', $path, $callback);
    }

    public function put(string $path, array $callback)
    {
        $this->addRoute('put', $path, $callback);
    }

    public function delete(string $path, array $callback)
    {
        $this->addRoute('delete', $path, $callback);
    }

    private function addRoute(string $method, string $path, array $callback)
    {
        $this->routes[$method][] = new Route($method, $path, $callback);
    }

    public function fetch(string $url, string $method)
    {
        foreach ($this->routes[$method] as $route) {
            if ($route->match($url, $method)) {
                return $route->run($url);
            }
        }

        throw new ApplicationException('page not found', 404);
    }
}