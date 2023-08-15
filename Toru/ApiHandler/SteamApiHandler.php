<?php

namespace Toru\ApiHandler;

require_once("ApiHandler.php");
class SteamApiHandler extends ApiHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function printResponse($args)
    {
        if (!in_array($args[0], $this->allowed_inputs)) {
            return "BLOCKED ACTION";
        }

        $steamApiUrl = "https://api.steampowered.com/ISteamRemoteStorage/GetCollectionDetails/v1/";
        $apiKey = $_ENV["STEAM_API_KEY"];

        // Set up POST data
        $postData = array(
            "key" => $apiKey,
            "steamid" => $args[0],
	    "collectioncount" => 1,
            "publishedfileids[0]" => $args[1]
        );


        // Set up options for the POST request
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query($postData)
            )
        );

        // Create context and send the POST request
        $context = stream_context_create($options);
        $response = file_get_contents($steamApiUrl, false, $context);

        return $response;
    }
}
