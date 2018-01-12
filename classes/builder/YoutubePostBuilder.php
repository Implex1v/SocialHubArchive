<?php

class YoutubePostBuilder {
    /**
     * Returns a list of Post objects which contains all data to display the youtube video. The youtube video post object will be persisted
     * @param Creator $creator The creator of the youtube videos
     * @param $response string The builder response string of the youtube api call
     * @return array An array containing the posts or an empty array if the an error occurred
     */
    public function buildYoutubePosts(Creator $creator, $response) {
        if(!$creator) {
            throw new RuntimeException("creator is null");
        }

        if(!$response) {
            throw new RuntimeException("response is null");
        }

        $videos = json_decode($response, true);
        if(is_array($videos) AND $videos['items']) {
            $list = array();

            for($i = 0; $i < sizeof($videos['items']); $i++) {
                $video = $this->buildYoutubePost($creator, $videos['items'][$i]);
                if($video) {
                    $list[] = $video;
                }
            }

            return $list;
        } else {
            return array();
        }
    }

    private function buildYoutubePost(Creator $creator, array $video) {
        $dao = new PostDAOImpl();

        if(! $dao->postExits($creator->getId(), $video['snippet']['resourceId']['videoId'], "Youtube")) {
            $post = new Post();
            $post->setContent($video['snippet']['title']);
            $post->setComment($video['snippet']['thumbnails']['medium']['url']);
            $post->setOriginalId($video['snippet']['resourceId']['videoId']);
            $post->setChannel("Youtube");
            $post->setCreatorId($creator->getId());
            $post->setLink($this->buildYoutubeLink($video['snippet']['resourceId']['videoId']));
            $post->setReleased($this->convertTimes($video['contentDetails']['videoPublishedAt']));
            $post = $dao->create($post);

            return $post;
        } else {
            return null;
        }
    }

    private function buildYoutubeLink($videoId) {
        return "https://www.youtube.com/watch?v=" . $videoId;
    }

    private function convertTimes($ytDatetime) {
        return date("Y-m-d H:i:s", strtotime($ytDatetime));
    }
}