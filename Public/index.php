<?php
session_start();
use Dotenv\Dotenv;


require_once __DIR__ . '/../src/support/helpers.php';
require_once base_path() . '/vendor/autoload.php';
require_once base_path() . '/Routes/web.php';

// $route = new Route(new Request, new Response);

//  $route->resolve() ;


$env = Dotenv::createMutable(base_path());
$env->load();

app()->run();
