<?php
require_once __DIR__ . "/../app/init.php";

define("BASE_URL", "http://localhost:8080/public");
define("STORAGE_URL", "http://localhost:8080/app/storage");


(new App())->handleRequest();
