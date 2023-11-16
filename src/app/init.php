<?php

require_once __DIR__ . "/core/app.php";
require_once __DIR__ . "/core/router.php";
require_once __DIR__ . "/database/database.php";

require_once __DIR__ . "/controllers/not_found.php";

require_once __DIR__ . "/controllers/dashboard/get_layout.php";
require_once __DIR__ . "/controllers/dashboard/get_main.php";
require_once __DIR__ . "/controllers/dashboard/get_episode.php";
require_once __DIR__ . "/controllers/dashboard/get_add_episode.php";
require_once __DIR__ . "/controllers/dashboard/get_edit_episode.php";
require_once __DIR__ . "/controllers/dashboard/post_add_episode.php";
require_once __DIR__ . "/controllers/dashboard/post_edit_episode.php";
require_once __DIR__ . "/controllers/dashboard/get_user_podcast.php";
require_once __DIR__ . "/controllers/dashboard/delete_episode.php";
require_once __DIR__ . "/controllers/dashboard/get_add_podcast.php";
require_once __DIR__ . "/controllers/dashboard/post_add_podcast.php";
require_once __DIR__ . "/controllers/dashboard/get_edit_podcast.php";
require_once __DIR__ . "/controllers/dashboard/post_edit_podcast.php";
require_once __DIR__ . "/controllers/dashboard/delete_podcast.php";

require_once __DIR__ . "/controllers/podcast/get_page.php";
require_once __DIR__ . "/controllers/episode/post_play_episode.php";
require_once __DIR__ . "/controllers/podcast/post_page.php";


require_once __DIR__ . "/controllers/logout/logout.php";

require_once __DIR__ . "/controllers/home/get_home.php";
require_once __DIR__ . "/controllers/login/get_login.php";
require_once __DIR__ . "/controllers/login/post_login.php";

require_once __DIR__ . "/controllers/library/get_library.php";
require_once __DIR__ . "/controllers/playlist/get_playlist.php";
require_once __DIR__ . "/controllers/playlist/post_playlist.php";
require_once __DIR__ . "/controllers/playlist/delete_playlist.php";
require_once __DIR__ . "/controllers/library/get_library.php";
require_once __DIR__ . "/controllers/library/post_library.php";
require_once __DIR__ . "/controllers/library/delete_library.php";
require_once __DIR__ . "/controllers/signup/get_signup.php";
require_once __DIR__ . "/controllers/signup/post_signup.php";
require_once __DIR__ . "/controllers/search/get_search.php";
require_once __DIR__ . "/controllers/profile/get_profile.php";
require_once __DIR__ . "/controllers/profile/update_profile.php";
require_once __DIR__ . "/controllers/subscription/post_subscription.php";

require_once __DIR__ . "/controllers/player/mount_player.php";
require_once __DIR__ . "/controllers/player/get_episode_played.php";

require_once __DIR__ . "/controllers/app/app_controller.php";
require_once __DIR__ . "/controllers/seed/post_seed.php";

require_once __DIR__ . "/controllers/podcast/get_podcast.php";
require_once __DIR__ . "/controllers/episode/get_episode.php";
require_once __DIR__ . "/controllers/podcast/get_random_podcast.php";

require_once __DIR__ . "/models/podcast.php";
require_once __DIR__ . "/models/episode.php";
require_once __DIR__ . "/models/user.php";
require_once __DIR__ . "/models/playlist.php";
