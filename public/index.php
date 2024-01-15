<?php

namespace mateable;

use Dotenv\Dotenv;

/**
 * @author SGreen <sgreen@mateable.com>
 * @package mateable
 */

require_once '../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

new Init();
