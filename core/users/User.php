<?php

/**
 * Copyright (c) 2024. Mateable LLC
 */

namespace mateable\core\users;

use app\system\db\DBModel;

abstract class User extends DBModel
{
    abstract public function displayName();
    abstract public function displayFirstName();
    abstract public function displayLastName();
    abstract public function displayUserName();
    abstract public function displayUserID();
}