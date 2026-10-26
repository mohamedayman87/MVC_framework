<?php
namespace Moayman\Mvc\Http;

use Moayman\Mvc\View\view;


class Route
{
    public Request $request;
    public Response $response;
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public static array $routes = [];

    public static function get($route, $action)
    {
        self::$routes["get"][$route] = $action;
    }
    public static function post($route, $action)
    {
        self::$routes["post"][$route] = $action;
    }

    public function resolve()
    {
        $path = $this->request->path();
        $method = $this->request->method();

        $action = self::$routes[$method][$path] ?? false;

        if (!array_key_exists($path, self::$routes[$method])) {
        $this->response->setStatusCode(404);
         view::makeError('404');
        }

        if (!$action) {
            return;
        }
        if (is_callable($action)) {
            call_user_func_array($action, []);
        } elseif (is_array($action)) {
            call_user_func_array([new $action[0], $action[1]], []);
        }
    }
}