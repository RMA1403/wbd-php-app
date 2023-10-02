<?php

require_once __DIR__ . "/../app/init.php";

define("BASE_URL", "http://localhost:8080/public");

(new App())->handleRequest();
