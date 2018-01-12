<?php

if(! class_exists("LayoutEngine")) {
    require __DIR__ . "/../util/LayoutEngine.php";
}

class CardBuilder {
    public function buildCards(array $posts) {
        if(!$posts) {
            throw new RuntimeException("cards are null");
        }

        $html = "";
        foreach($posts as $card) {
            $html .= $this->buildCard($card);
        }

        return $html;
    }

    public function buildCard(Post $post) {
        if(is_a($post, "Post")) {
            switch ($post->getChannel()) {
                case "Youtube":
                    return $this->buildYoutubeCard($post);
                case "Twitter":
                    return $this->buildTwitterCard($post);
                case "Instagram":
                    return $this->buildInstagramCard($post);
                default:
                    return null;
            }
        } else {
            return null;
        }
    }

    private function buildYoutubeCard(Post $post) {
        $engine = new LayoutEngine(__DIR__ . "/../../templates/card_youtube.tpl");
        $engine->put("link", $post->getLink());
        $engine->put("date", $post->getReleased());
        $engine->put("title", $post->getContent());
        $engine->put("content", $post->getComment());

        return $engine->finalize();
    }

    private function buildTwitterCard(Post $post) {
        $engine = new LayoutEngine(__DIR__ . "/../../templates/card_twitter.tpl");
        $engine->put("link", $post->getLink());
        $engine->put("date", $post->getReleased());
        $engine->put("content", $post->getContent());

        return $engine->finalize();
    }

    private function buildInstagramCard(Post $post) {
        $engine = new LayoutEngine(__DIR__ . "/../../templates/card_instagram.tpl");
        $engine->put("link", $post->getLink());
        $engine->put("date", $post->getReleased());
        $engine->put("content", $post->getContent());
        $engine->put("title", $post->getComment());

        return $engine->finalize();
    }
}