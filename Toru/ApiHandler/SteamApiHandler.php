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
        if (!in_array($input, $this->allowed_inputs)) {
            return "BLOCKED ACTION";
        }

        $steamApiUrl = "https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/";
        $apiKey = $_ENV["STEAM_API_KEY"];
        $steamUserId = $input;

        $postData = array(
            "key" => $apiKey,
            "steamid" => $steamUserId,
            "startindex" => isset($_GET["startindex"]) ? $_GET["startindex"] : 0,
            "pagesize" => isset($_GET["pagesize"]) ? $_GET["pagesize"] : 100
        );

        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($postData)
            )
        );

        $context = stream_context_create($options);
        $response = file_get_contents($steamApiUrl, false, $context);

        return $response;
    }
}