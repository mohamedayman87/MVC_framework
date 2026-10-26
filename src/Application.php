<?php
namespace Moayman\Mvc;

use Moayman\Mvc\Database\DB;
use Moayman\Mvc\Database\Managers\MySQLManager;
use Moayman\Mvc\Http\Request;
use Moayman\Mvc\Http\Response;
use Moayman\Mvc\Http\Route;
use Moayman\Mvc\Support\config;
use Moayman\Mvc\Support\Session;
class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;
    protected DB $db;
    protected config $config;
    protected Session $session;
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->route = new Route($this->request, $this->response);
        $this->config = new config($this->loadConfigration());
        $this->db = new DB($this->getDbDriver());
    }
    protected function getDbDriver()
    {
        return match (env('DB_DRIVER')) {
            'MySQL' => new MySQLManager,
            default => new MySQLManager
        };
    }
    protected function loadConfigration()
    {
        foreach (scandir(config_path()) as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filename = explode('.', $file)[0];
            yield $filename => require config_path() . $file;
        }
    }

    public function run()
    {
        $this->route->resolve();
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }
}