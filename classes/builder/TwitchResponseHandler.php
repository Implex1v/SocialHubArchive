<?php

/**
 * Class TwitchResponseHandler for handling the response of the twitch api call
 */
class TwitchResponseHandler {
    /**
     * Handles the parsing of the api response for getting the twitch user id and persists it to the database
     * @param $response string The response of from the api call
     * @param $username string The name of the user
     */
    function handleTwitchIdResponse($response, $username) {
        if(!$response) {
            throw new RuntimeException("response is null");
        }
        if(!$username) {
            throw new RuntimeException("username is null");
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

    /**
     * Handles the parsing of the api response for getting the latest twitch videos of the user and persists them into the database
     * @param $response string The response of the api call
     * @param $username string The name of the user
     */
    function handleTwitchVideoResponse($response, Creator $creator) {
        if(!$response) {
            throw new RuntimeException("response is null");
        }
        if(!$creator) {
            throw new RuntimeException("username is null");
        }

        $result = json_decode($response, true);
        if($result AND $result['_total'] > 0) {
            $videos = $result['videos'];

            foreach($videos as $video) {
                $this->buildPost($video, $creator);
            }
        }
    }

    private function buildPost($video, Creator $creator) {
        $postDao = new PostDAOImpl();

        if(!$postDao->postExits($creator->getId(), $video['_id'], "Twitch")) {
            $post = new Post();
            $post->setLink($video['url']);
            $post->setContent($video['title']);
            $post->setComment($video['thumbnails']['large'][0]['url']);
            $post->setCreatorId($creator->getId());
            $post->setChannel("Twitch");
            $post->setOriginalId($video['_id']);
            $post->setReleased(date("Y-m-d H:i:s", strtotime($video['published_at'])));

            $postDao->create($post);
        }
    }
}