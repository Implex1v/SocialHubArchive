<?php

require __DIR__ . "/classes/util/autoload.php";
require __DIR__ . "/classes/util/LayoutEngine.php";
require __DIR__ . "/classes/ApplicationController.php";

$controller = new ApplicationController();
$engine = new LayoutEngine(__DIR__ . "/templates/index.tpl");

$result = $controller->getIndexPosts();
if($result) {
    $engine->put("lastPostTime", $result['time']);
    $engine->put("posts", $result['posts']);
} else {
    $ngin = new LayoutEngine(__DIR__ . "/templates/card_no_content.tpl");
    $engine->put("posts", $ngin->finalize());
    $engine->put("lastPostTime", time());
}

$page = $engine->finalize();
echo $page;