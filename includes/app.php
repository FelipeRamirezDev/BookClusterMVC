<?php

include __DIR__ . "/functions.php";
require __DIR__ . "/../config/database.php";
require __DIR__ . "/../vendor/autoload.php";

use Model\ActiveRecord;

ActiveRecord::setConnection($conn);