<?php

function db_is_access_denied($_db = NULL) {
    if ( is_null($_db) ) {
        global $db;
    } else {
        $db = $_db;
    }
    return in_array($db->connect_errno, array(1044,1045));
}

function db_get_root_connection() {
    global $cfg;
    $root_pw_tryouts = array("","mysql","root");
    foreach ( $root_pw_tryouts as $password ) {
        $db = @new mysqli($cfg["db"]["hostname"], "root", $password, null, $cfg["db"]["port"]);
        if ( !db_is_access_denied($db) ) {
            return $db;
        }
    }
    return false;
}

function initial_db() {
    if ( !( $root = db_get_root_connection() ) ) {
        return false;
    }
    if ( db_create_database($root) && db_create_user($root) && db_grand_user_privileges($root)
         && db_create_tables() && db_insert_init_data() ) {
        return true;
    }
    return false;
}

function db_create_database($db) {
    global $cfg;
    $res = $db->query("CREATE DATABASE {$cfg["db"]["database"]} "
             . "CHARACTER SET utf8 "
             . "COLLATE utf8_general_ci");
    return true;
}

function db_create_user($db) {
    global $cfg;
    $res = $db->query("CREATE USER '{$cfg["db"]["username"]}'@'{$cfg["db"]["hostname"]}' "
            . "IDENTIFIED BY '{$cfg["db"]["password"]}'");
    return true;
}

function db_grand_user_privileges($db) {
    global $cfg;
    $res = $db->query("GRANT ALL PRIVILEGES "
            . "ON {$cfg["db"]["database"]} . * "
            . "TO  '{$cfg["db"]["username"]}'@'{$cfg["db"]["hostname"]}' "
            . "WITH GRANT OPTION");
    $db->query("FLUSH PRIVILEGES");
    return true;
}

function db_create_tables() {
    global $cfg, $db;
    return true;
}

function db_insert_init_data() {
    global $cfg, $db;
    return true;
}