<?php

require __DIR__ . "/classes/util/autoload.php";
require __DIR__ . "/classes/ApplicationController.php";

if($_GET['action']) {
    if($_GET['action'] == "fetch") {
        // TODO refresh
    } elseif($_GET['action'] == "getPost" AND $_GET['time']) {
        $time = $_GET['time'];
        $controller = new ApplicationController();

        $data = $controller->readPosts($time);
        if($data AND $data['posts']) {
            $posts = $data['posts'];
            $span = $controller->getTimeSpan($data['time']);
            echo $posts."\n".$span;
        } else {
            $engine = new LayoutEngine(__DIR__ . "/templates/card_no_content.tpl");
            echo $engine->finalize();
        }

    }
}

