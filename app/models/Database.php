<?php

namespace App\Models;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    function __construct() {
        $capsule = new Capsule;

        $capsule->addConnection([
          'driver' => config('db.driver'),
          'host' => config('db.host'),
          'database' => config('db.database'),
          'username' => config('db.username'),
          'password' => config('db.password'),
          'charset' => config('db.charset'),
          'collation' => config('db.collation'),
          'prefix' => '',
        ]);

        $capsule->bootEloquent();
    }
}