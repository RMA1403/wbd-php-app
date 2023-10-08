<?php
require_once __DIR__ . "/../app/init.php";

define("BASE_URL", "http://localhost:8080/public");
define("STORAGE_URL", "http://localhost:8080/app/storage");

define('AUDIO_MAP', ['audio/mpeg' => '.mp3']);

define('IMAGE_MAP', [
  'image/jpeg' => '.jpeg',
  'image/png' => '.png'
]);


(new App())->handleRequest();
