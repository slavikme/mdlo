<?php

function response($response_data, $response_code = 200) {
    http_response_code($response_code);
    die($response_data);
}

if ( basename(__FILE__) === basename(filter_input(INPUT_SERVER, 'SCRIPT_FILENAME')) ) {
    response("You cannot access this path directly", 403);
}

require_once __DIR__ . './config.php';

require_once __DIR__ . './functions/db_functions.php';
