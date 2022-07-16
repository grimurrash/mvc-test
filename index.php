<?php

use app\core\Kernel;

define('DOCROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

require_once __DIR__ . '/vendor/autoload.php';

Kernel::init();