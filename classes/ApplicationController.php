<?php

require __DIR__ . "/builder/CardBuilder.php";
require __DIR__ . "/builder/FragmentBuilder.php";

class ApplicationController {
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