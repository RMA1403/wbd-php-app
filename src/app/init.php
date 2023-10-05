<?php
require_once __DIR__ . "/core/app.php";
require_once __DIR__ . "/core/router.php";
require_once __DIR__ . "/database/database.php";

require_once __DIR__ . "/controllers/not_found.php";

require_once __DIR__ . "/controllers/dashboard/get_layout.php";
require_once __DIR__ . "/controllers/dashboard/get_main.php";
require_once __DIR__ . "/controllers/dashboard/get_episode.php";
require_once __DIR__ . "/controllers/dashboard/get_add_episode.php";
require_once __DIR__ . "/controllers/dashboard/post_add_episode.php";

require_once __DIR__ . "/controllers/home/get_home.php";
require_once __DIR__ . "/controllers/login/get_login.php";
require_once __DIR__ . "/controllers/signup/get_signup.php";

require_once __DIR__ . "/models/podcast.php";
require_once __DIR__ . "/models/episode.php";
require_once __DIR__ . "/models/user.php";
