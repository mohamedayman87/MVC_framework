<?php
namespace Moayman\Mvc\Http;

use Moayman\Mvc\Support\Arr;

class Request
{
    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    public function path()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        return str_contains($path, '?') ? explode("?", $path)[0] : $path;
    }

    public function all(){
        return $_REQUEST;
    }
    

    public function get($key){
        return (Arr::get($this->all(),$key));
    }

    public function only($keys){
        return (Arr::array_only($this->all(),$keys));
    }
    
}