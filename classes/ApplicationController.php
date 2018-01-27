<?php

require __DIR__ . "/builder/CardBuilder.php";
require __DIR__ . "/builder/FragmentBuilder.php";

/**
 * Class ApplicationController is the central controller of the application and provides all functions
 */
class ApplicationController {
    /**
     * Fetches all new posts from all social media channels and persists them into the database
     */
    public function fetchAll() {
        require __DIR__ . "/rest/TwitterRESTClient.php";
        require __DIR__ . "/builder/TwitterPostBuilder.php";
        require __DIR__ . "/rest/YouTubeRESTClient.php";
        require __DIR__ . "/builder/YoutubePostBuilder.php";
        require __DIR__ . "/rest/InstagramWebsiteClient.php";
        require __DIR__ . "/rest/TwitchRESTClient.php";
        require __DIR__ . "/builder/TwitchResponseHandler.php";

        $cDao = new CreatorDAOImpl();
        $creator = $cDao->readByName("Gronkh");

        $twitterClient = new TwitterRESTClient();
        $twitterResult = $twitterClient->readFeed($creator->getTwitterId(), 10);
        $twitterBuilder = new TwitterPostBuilder();
        $twitterBuilder->buildTwitterPosts($creator, $twitterResult);

        $ytClient = new YouTubeRESTClient();
        $ytResult = $ytClient->getLatestUploads("UUYJ61XIK64sp6ZFFS8sctxw");
        $ytBuilder = new YoutubePostBuilder();
        $ytBuilder->buildYoutubePosts($creator, $ytResult);

        $client = new InstagramWebsiteClient();
        $client->getLatestImages($creator);

        $twitchClient = new TwitchRESTClient();
        $twitchResult = $twitchClient->getLatestVideos($creator->getTwitchId());
        $twitchHandler = new TwitchResponseHandler();
        $twitchHandler->handleTwitchVideoResponse($twitchResult, $creator);
    }

    /**
     * Returns the initial page posts
     * @return array|null An array containing the posts and the time of the last post
     */
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

    /**
     * @param $timeStamp
     * @param int $count
     * @return array|null
     */
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