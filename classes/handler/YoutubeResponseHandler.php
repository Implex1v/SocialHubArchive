<?php
/**
 * Created by PhpStorm.
 * User: Implex1v
 * Date: 12.01.18
 * Time: 13:25
 */

class YoutubeResponseHandler {
    /**
     * Reads the youtube api call response for channel id and upload playlist id and persists them into the database.
     * @param $response string The json string response of the api call
     * @return bool true if inserting was successful otherwise false
     */
    public function handleIdPlaylistResponse($response) {
        if(!$response) {
            throw new RuntimeException("response is null");
        }

        $result = json_decode($response, true);
        if(is_array($result) AND is_array($result['items'])) {
            $id = $result['items'][0]['id'];
            $uploadsId = $result['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

            $creatorDao = new CreatorDAOImpl();
            $creator = $creatorDao->readByName("Gronkh");
            $creator->setYoutubeId($id);
            $creator->setYoutubeUpload($uploadsId);

            $creatorDao->update($creator);

            return true;
        } else {
            return false;
        }
    }
}