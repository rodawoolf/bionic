<?php


global $DIR;
define('DIR',__DIR__);
try {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';
} catch (\Exception $e) {
    print($e->getMessage());
    die;
}

