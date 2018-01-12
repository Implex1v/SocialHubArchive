<?php

require __DIR__ . "/classes/util/autoload.php";
require __DIR__ . "/classes/util/LayoutEngine.php";

$dao = new PostDAOImpl();

$posts = "";
$p = $dao->readLatestPostsOf(1);
foreach($p as $post) {
    if($post->getChannel() == "Twitter") {
        $engine = new LayoutEngine(__DIR__ . "/templates/card_twitter.tpl");
        $engine->put("link", $post->getLink());
        $engine->put("date", $post->getReleased());
        $engine->put("content", $post->getContent());

        $posts .= $engine->finalize();
    } elseif($post->getChannel() == "Youtube") {
        $engine = new LayoutEngine(__DIR__ . "/templates/card_youtube.tpl");
        $engine->put("link", $post->getLink());
        $engine->put("date", $post->getReleased());
        $engine->put("title", $post->getContent());
        $engine->put("content", $post->getComment());

        $posts .= $engine->finalize();
    }
}

$engine = new LayoutEngine(__DIR__ . "/templates/index.tpl");
$engine->put("posts", $posts);
$page = $engine->finalize();
echo $page;
