<?php

/**
 * Class TwitchResponseHandler for handling the response of the twitch api call
 */
class TwitchResponseHandler {
    /**
     * Handles the twitch api response for getting the twitch user id and persists it to the database
     * @param $response string The response of from the api call
     * @param $username string The name of the user
     */
    function handleTwitchIdResponse($response, $username) {
        if(!$response) {
            throw new RuntimeException("response is null");
        }

        $result = json_decode($response, true);
        if($result AND $result['_total'] > 0) {
            $creatorDao = new CreatorDAOImpl();
            $creator = $creatorDao->readByName($username);

            if($creator) {
                $creator->setTwitchId($result["users"][0]['_id']);
                $creator = $creatorDao->update($creator);
            }
        }
    }
}