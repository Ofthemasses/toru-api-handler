<?php
$handler = new \Toru\ApiHandler\SteamApiHandler();

header("Content-Type: application/json");
echo $handler->printResponse($_GET("user"));