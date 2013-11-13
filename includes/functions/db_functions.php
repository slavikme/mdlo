<?php

function db_is_access_denied($_db = NULL) {
    if ( is_null($_db) ) {
        global $db;
    } else {
        $db = $_db;
    }
    return in_array($db->connect_errno, array(1044,1045));
}

function initial_db() {
    db_create_database();
    db_create_user();
    db_grand_user_privileges();
    db_create_tables();
    db_insert_init_data();
}

function db_create_database() {
    global $cfg;
    $root_pw_tryouts = array("","mysql","root");
    $db = new mysqli($cfg["db"]["hostname"], "root", "mysql", null, $cfg["db"]["port"]);
    if ( db_is_access_denied($db) ) {
        
    }
    $res = $db->query("CREATE DATABASE {$cfg["db"]["database"]} "
             . "CHARACTER SET utf8 "
             . "COLLATE utf8_general_ci");
    var_dump(array(
        "result" => $res,
        "errno" => $db->connect_errno,
        "error" => $db->connect_error,
    ));
}

function db_create_user() {
    global $cfg, $db;
    
}

function db_grand_user_privileges() {
    global $cfg, $db;
    
    //FLUSH PRIVILEGES;
}

function db_create_tables() {
    global $cfg, $db;
    
}

function db_insert_init_data() {
    global $cfg, $db;
    
}