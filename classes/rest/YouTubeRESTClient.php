<?php

if(! class_exists("RESTClient")) {
    require __DIR__ . "/RESTClient.php";
}
class YouTubeRESTClient {
    /**
     * Returns the json response of the youtube api call for getting the given user's channel id and upload playlist id.
     * Will also return null if there is no valid youtube api entry in the database.
     * @param $youtubeUsername string The username of the youtuber
     * @return string|null Returns the json string on success otherwise null
     */
    public function getIdAndUploadPlaylist($youtubeUsername) {
        if(!$youtubeUsername) {
            throw new RuntimeException("youtubeUsername is null");
        }

        $apiDao = new ApiDAOImpl();
        $yt = $apiDao->readByName("Youtube");

        if($yt) {
            $client = new RESTClient();
            $client->setUrl("https://www.googleapis.com/youtube/v3/channels");
            $client->addQueryParam("forUsername", $youtubeUsername);
            $client->addQueryParam("part", "contentDetails");
            $client->addQueryParam("key", $yt->getToken());

            $result = $client->run();
            if($result) {
                return $result;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }

    /**
     * Returns the json response of the youtube api call for getting the latest upload items of the given playlist id
     * @param $playlistId string The id of the playlist to search for
     * @return string|null Returns the json string on success otherwise null
     */
    public function getLatestUploads($playlistId) {
        if(!$playlistId) {
            throw new RuntimeException("playlistId is null");
        }

        $apiDao = new ApiDAOImpl();
        $yt = $apiDao->readByName("Youtube");
        $creatorDao = new CreatorDAOImpl();
        $creator = $creatorDao->readByName("Gronkh");

        if($yt AND $creator AND $creator->getYoutubeUpload()) {
            $client = new RESTClient();
            $client->setUrl("https://www.googleapis.com/youtube/v3/playlistItems");
            $client->addQueryParam("playlistId", $creator->getYoutubeUpload());
            $client->addQueryParam("maxResults", 25);
            $client->addQueryParam("part", "snippet,contentDetails");
            $client->addQueryParam("key", $yt->getToken());

            $result = $client->run();
            if($result) {
                return $result;
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}