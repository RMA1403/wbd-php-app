<?php

<<<<<<< HEAD
require_once __DIR__ . "/../app/init.php";

define("BASE_URL", "http://localhost:8080/public");
define("STORAGE_URL", "http://localhost:8080/app/storage");

(new App())->handleRequest();
=======
require_once '../app/init.php';

$app = new App;
>>>>>>> 66c4f8f (setup controller)
