<?php

require __DIR__ . "/builder/CardBuilder.php";
require __DIR__ . "/builder/FragmentBuilder.php";

class ApplicationController {
    public function getIndexPosts() {
        $dao = new PostDAOImpl();
        $p = $dao->readLatestPostsOf(1);
        $time = $this->getTimestamp($p);

        $builder = new CardBuilder();
        $posts = $builder->buildCards($p);

        return array("posts" => $posts, "time" => $time);
    }

    public function readPosts($timeStamp, $count = 12) {
        $dao = new PostDAOImpl();
        $time = date("Y-m-d H:i:s", $timeStamp);
        $p = $dao->readPosts(1, $time, $count);
        $timeStamp = $this->getTimestamp($p);

        $builder = new CardBuilder();
        $posts = $builder->buildCards($p);

        return array("posts" => $posts, "time" => $timeStamp);
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