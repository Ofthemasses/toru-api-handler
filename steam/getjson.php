<?php
use \Toru\ApiHandler\SteamApiHandler;
$handler = new SteamApiHandler();

header("Content-Type: application/json");
echo $handler->printResponse($_GET("user"));