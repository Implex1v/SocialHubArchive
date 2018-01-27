<?php

require __DIR__ . "/builder/CardBuilder.php";
require __DIR__ . "/builder/FragmentBuilder.php";

class ApplicationController {
    public function fetchAll() {
        require __DIR__ . "/rest/TwitterRESTClient.php";
        require __DIR__ . "/builder/TwitterPostBuilder.php";
        require __DIR__ . "/rest/YouTubeRESTClient.php";
        require __DIR__ . "/builder/YoutubePostBuilder.php";
        require __DIR__ . "/rest/InstagramWebsiteClient.php";

        $cDao = new CreatorDAOImpl();
        $creator = $cDao->readByName("Gronkh");

        $twClient = new TwitterRESTClient();
        $result = $twClient->readFeed($creator->getTwitterId(), 10);
        $builder = new TwitterPostBuilder();
        $builder->buildTwitterPosts($creator, $result);

        $ytClient = new YouTubeRESTClient();
        $result = $ytClient->getLatestUploads("UUYJ61XIK64sp6ZFFS8sctxw");
        $ytBuilder = new YoutubePostBuilder();
        $ytBuilder->buildYoutubePosts($creator, $result);

        $client = new InstagramWebsiteClient();
        $client->getLatestImages($creator);
    }

    public function getIndexPosts() {
        $dao = new PostDAOImpl();
        $postArray = $dao->readLatestPostsOf(1);
        if($postArray) {
            $time = $this->getTimestamp($postArray);

            $builder = new CardBuilder();
            $posts = $builder->buildCards($postArray);

            return array("posts" => $posts, "time" => $time);
        } else {
            return null;
        }
    }

    public function readPosts($timeStamp, $count = 12) {
        $dao = new PostDAOImpl();
        $time = date("Y-m-d H:i:s", $timeStamp);
        $postArray = $dao->readPosts(1, $time, $count);

        if($postArray) {
            $timeStamp = $this->getTimestamp($postArray);
            $builder = new CardBuilder();
            $posts = $builder->buildCards($postArray);

            return array("posts" => $posts, "time" => $timeStamp);
        } else {
            return null;
        }
    }

    public function readTwitchId($username) {
        if(!$username) {
            throw new RuntimeException("username is null");
        }

        $creatorDao = new CreatorDAOImpl();
        $creator = $creatorDao->readByName($username);
        if($creator) {
            require __DIR__ . "/rest/TwitchRESTClient.php";
            require __DIR__ . "/handler/TwitchResponseHandler.php";

            $twitchClient = new TwitchRESTClient();
            $response = $twitchClient->getIdFromUsername($username);
            if($response) {
                $handler = new TwitchResponseHandler();
                $handler->handleTwitchIdResponse($response, $username);
            }
        }
    }

    public function getTimeSpan($time) {
        $builder = new FragmentBuilder();
        return $builder->buildTimeSpan($time);
    }

    private function getTimestamp(array $posts) {
        $size = sizeof($posts);
        if($size > 0) {
            $post = $posts[$size - 1];

            return strtotime($post->getReleased());
        } else {
            return null;
        }
    }
}