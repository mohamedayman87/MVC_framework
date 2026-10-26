<?php

namespace Moayman\Mvc\Database\Managers\Contracts;

use ReflectionFunctionAbstract;

interface DatabaseManager
{
    public function connect(): \PDO;
    public function query(string $query, $values = []);
    public function create($data);
    public function read($columns = "*", $filter = null);

    public function update($id, $data);
    public function delete($id);

}