<?php

require_once __DIR__ . './functions.php';

if ( basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME']) ) {
    response("You cannot access this path directly", 403);
}

require_once __DIR__ . './config.php';

$db = new mysqli($cfg["db"]["hostname"], $cfg["db"]["username"], $cfg["db"]["password"], $cfg["db"]["database"], $cfg["db"]["port"]);
if ( $db->connect_errno ) {
    try {
        if ( db_is_access_denied() ) {
            initial_db();
        }
    } catch ( Exception $e ) {
        response($e->getMessage(), 401);
    }
}

