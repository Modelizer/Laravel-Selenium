<?php

$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

require_once __DIR__.'/stubs/public/index.php';
