<?php

define('DOCROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);

require_once DOCROOT . 'vendor/autoload.php';

use App\Core\Kernel;
use App\Core\Route;

Kernel::init();

Route::distribute();