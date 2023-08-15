<?php
require_once('../Toru/ApiHandler/SteamApiHandler.php');
require_once('../config.php');

use \Toru\ApiHandler\SteamApiHandler;
$handler = new SteamApiHandler();

header("Content-Type: application/json");
echo $handler->printResponse([$_GET["user"], $_GET["collection"]]);
