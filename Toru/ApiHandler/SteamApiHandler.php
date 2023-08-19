<?php

namespace Toru\ApiHandler;

require_once("ApiHandler.php");

class SteamApiHandler extends ApiHandler
{

    public function __construct()
    {
        parent::__construct();
    }

    public function printResponse($input)
    {
        if (!in_array($input, $this->allowed_inputs)){ return "BLOCKED ACTION"; }

        $steamApiUrl = "https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/";
        $apiKey = $_ENV["STEAM_API_KEY"];
        $steamUserId = $input;

        $startItem = isset($_GET["startindex"]) ? $_GET["startindex"] : 0;
        $pageSize = isset($_GET["pagesize"]) ? $_GET["pagesize"] : 100;

        $url = "$steamApiUrl?key=$apiKey&steamid=$steamUserId&startindex=$startItem&pagesize=$pageSize";

        return file_get_contents($url);
    }
}