<?php
require_once('../Toru/ApiHandler/SteamApiHandler.php');
require_once('../config.php');

use \Toru\ApiHandler\ItchioApiHandler;
$handler = new ItchioApiHandler();

header("Content-Type: application/json");
echo $handler->printResponse([$_GET["user"], $_GET["collection"]]);
