<?php

namespace Moayman\Mvc\Database\Concerns;

use Moayman\Mvc\Database\Managers\Contracts\DatabaseManager;

class ConnectsTo
{
    public static function connect(DatabaseManager $manager)
    {
        return $manager->connect();
    }

}