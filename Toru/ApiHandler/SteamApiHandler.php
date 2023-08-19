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

        $steamApiCollectionUrl = "https://api.steampowered.com/ISteamRemoteStorage/GetCollectionDetails/v1/";
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
        $response = file_get_contents($steamApiCollectionUrl, false, $context);

        $decodedResponse = json_decode($response, true);

        if (isset($decodedResponse['response']['result']) && $decodedResponse['response']['result'] == 1) {
            $steamApiFileUrl = "https://api.steampowered.com/ISteamRemoteStorage/GetPublishedFileDetails/v1/";
            $children = $decodedResponse['response']['collectiondetails'][0]['children'];

            // Set up POST data
            $postData = array(
                "key" => $apiKey,
                "steamid" => args[0],
                "itemcount" => count($children)
            );

            $i = 0;
            // Add each file id
            foreach ($children as $child) {
                $postData["publishedfileids[$i]"] = $child['publishedfileid'];
            }

            // Set up options for the POST request
            $options = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'content' => http_build_query($postData)
                )
            );

            $context = stream_context_create($options);
            return file_get_contents($steamApiCollectionUrl, false, $context);
        }
        return "";
    }
}
