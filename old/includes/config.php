<?php

require_once __DIR__ . './functions.php';

if ( basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME']) ) {
    response("You cannot access this path directly", 403);
}

$cfg = array(
    "db" => array(
        "hostname"  => "localhost",
        "post"      => 3306,
        "username"  => "mdlo_user",
        "password"  => "j0G8Sow61",
        "database"  => "mdlo_db",
    ),
);
