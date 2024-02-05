<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\users;

use mateable\core\models\DB;

abstract class User extends DB
{
    abstract public function displayName();

    abstract public function displayFirstName();

    abstract public function displayLastName();

    abstract public function displayUserID();

    abstract public function displayEmail();

}