<?php

/**
 * Class TwitchRESTClient for calling the twitch api
 */
class TwitchRESTClient {
    /**
     * Returns a response containing the latest videos of the given twitch user
     * @param $twitchId int The id of the twitch user
     * @return mixed|null The http response or null if an error occurred
     */
    function getLatestVideos($twitchId) {
        if(!$twitchId) {
            throw new RuntimeException("twitchId is null");
        }

        $apiDao = new ApiDAOImpl();
        $twitch = $apiDao->readByName("Twitch");

        if($twitch) {
            $client = new RESTClient();
            $client->setUrl("https://api.twitch.tv/kraken/channels/".$twitchId."/videos");
            $client->addHeaderParam("Accept", "application/vnd.twitchtv.v5+json");
            $client->addHeaderParam("Client-ID", $twitch->getToken());
            $client->addQueryParam("sort", "time");

            return $client->run();
        } else {
            return null;
        }
    }

    /**
     * Returns the response of the api call for the user twitch id
     * @param $username string The name of the user
     * @return mixed|null The response or null if an error occurred
     */
    function getIdFromUsername($username) {
        if(!$username) {
            throw new RuntimeException("username is null");
        }

        $apiDao = new ApiDAOImpl();
        $twitch = $apiDao->readByName("Twitch");

        if($twitch) {
            $client = new RESTClient();
            $client->setUrl("https://api.twitch.tv/kraken/users");
            $client->addQueryParam("login", $username);
            $client->addHeaderParam("Accept", "application/vnd.twitchtv.v5+json");
            $client->addHeaderParam("Client-ID", $twitch->getToken());

            return $client->run();
        } else {
            return null;
        }
    }
}