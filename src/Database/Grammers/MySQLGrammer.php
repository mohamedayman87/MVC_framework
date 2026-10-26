<?php

namespace Moayman\Mvc\Database\Grammers;

use App\Models\Model;
class MySQLGrammer
{
    public static function buildInsertQuery($keys)
    {

        $values = '';
        for ($i = 1; $i <= (count($keys) * 2) - 1; $i++) {
            if ($i % 2) {
                $values .= '?';
            } else {
                $values .= ', ';
            }
        }
        $query = "INSERT INTO " . Model::getTableName() . " (`" . implode('`, `', $keys) . "`) VALUES(" . $values . ");";
        return $query;
    }

    public static function buildSelectQuery($columns, $filter)
    {
        if (is_array($columns)) {
            $columns = implode(', ', $columns);
        }

        $query = "SELECT {$columns} FROM " . Model::getTableName();
        if ($filter) {
            $query .= " WHERE {$filter[0]} {$filter[1]} ?";
        }
        return $query;
    }

    public static function buildDeleteQuery()
    {
        $query = "DELETE FROM " . Model::getTableName() . " WHERE id = ?;";
        return $query;
    }

    public static function buildUpdateQuery($keys)
    {
        $query = "UPDATE " . Model::getTableName() . " SET ";
        foreach ($keys as $key) {
            $query .= "{$key} = ?, ";
        }
        $query = rtrim($query, ", ") . " WHERE ID = ? ;";
        return $query;

    }




}