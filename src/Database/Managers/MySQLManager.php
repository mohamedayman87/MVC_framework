<?php
namespace Moayman\Mvc\Database\Managers;

use App\Models\Model;
use Moayman\Mvc\Database\Grammers\MySQLGrammer;
use Moayman\Mvc\Database\Managers\Contracts\DatabaseManager;
use PDO;
class MySQLManager implements DatabaseManager
{

    protected static $instance;

    public function connect(): PDO
    {
        if (!self::$instance) {
            self::$instance = new PDO(env("DB_DRIVER") . ":host=" . env("DB_HOST") . ";dbname=" . env("DB_DATABASE"), env("DB_USERNAME"), env("DB_PASSWORD"), [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        }
        return self::$instance;
    }
    public function query(string $query, $values = [])
    {
        $stmt = self::$instance->prepare($query);
        for ($i = 1; $i <= count($values); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {
        $query = MySQLGrammer::buildInsertQuery(array_keys($data));
        // return $query;
        $stmt = self::$instance->prepare($query);
        $values = array_values($data);
        for ($i = 1; $i <= count($values); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
        }
        $stmt->execute();
    }
    public function read($columns = "*", $filter = null)
    {
        $query = MySQLGrammer::buildSelectQuery($columns, $filter);
        $stmt = self::$instance->prepare($query);
        if ($filter) {
            $stmt->bindValue(1, $filter[2]);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, Model::getModel());
    }

    public function update($id, $attributes)
    {
        $query = MySQLGrammer::buildUpdateQuery(array_keys($attributes));
        $stmt = self::$instance->prepare($query);
        $values = array_values($attributes);
        for ($i = 1; $i <= count($values); $i++) {
            $stmt->bindValue($i, $values[$i - 1]);
            if ($i == count($values)) {
                $stmt->bindValue($i + 1, $id);
            }
        }
        return $stmt->execute();
    }
    public function delete($id)
    {
        $query = MySQLGrammer::buildDeleteQuery();

        $stmt = self::$instance->prepare($query);

        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }
}