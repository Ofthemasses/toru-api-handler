<?php

namespace Toru\ApiHandler;

class SteamApiHandler extends ApiHandler
{

    public function printResponse($input)
    {
        if (!in_array($this->allowed_inputs, $input)){ return; }

        $steamApiUrl = "https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/";
        $apiKey = getenv("STEAM_API_KEY");
        $steamUserId = $input;

        $startItem = isset($_GET["startindex"]) ? $_GET["startindex"] : 0;
        $pageSize = isset($_GET["pagesize"]) ? $_GET["pagesize"] : 100;

        $url = "$steamApiUrl?key=$apiKey&steamid=$steamUserId&startindex=$startItem&pagesize=$pageSize";

        return file_get_contents($url);
    }
}