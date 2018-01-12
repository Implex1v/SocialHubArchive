<?php

require __DIR__ . "/builder/CardBuilder.php";
class ApplicationController {
    public function getIndexPosts() {
        $dao = new PostDAOImpl();
        $p = $dao->readLatestPostsOf(1);
        $time = $this->getTimestamp($p);

        $builder = new CardBuilder();
        $posts = $builder->buildCards($p);

        return array("posts" => $posts, "time" => $time);
    }

    public function readPosts($lastPost, $count) {
        $dao = new PostDAOImpl();

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