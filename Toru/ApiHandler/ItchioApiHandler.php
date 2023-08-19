<?php

namespace Toru\ApiHandler;

require_once("ApiHandler.php");
class ItchioApiHandler extends ApiHandler
{
    public function __construct()
    {
        parent::__construct();
    }

    public function printResponse($args)
    {
        $apiKey = $_ENV["ITCHIO_API_KEY"];
        $itchioApiMyGamesUrl = "https://itch.io/api/1/$apiKey/my-games";
        return file_get_contents($itchioApiMyGamesUrl);
    }
}