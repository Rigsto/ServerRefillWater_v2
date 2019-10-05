<?php
define('DB_NAME','auriga_refillwater');

define('DB_USER','auriga_refill');

define('DB_PASSWORD','RefillWater');

define('DB_HOST', 'localhost');

define('DB_CHARSET', 'utf8mb4');

define('DB_COLLATE', '');

$db = new mysqli("localhost", "auriga_refill", "RefillWater", "auriga_refillwater");

if (!$db) {
    die("Bad Server Connection");
}