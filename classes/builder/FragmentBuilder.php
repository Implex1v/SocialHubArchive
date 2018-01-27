<?php

if(! class_exists("LayoutEngine")) {
    require __DIR__ . "/../util/LayoutEngine.php";
}

class FragmentBuilder {
    public function buildTimeSpan($time) {
        $layout = new LayoutEngine(__DIR__ . "/../../templates/post_latest_span.tpl");
        $layout->put("time", $time);

        return $layout->finalize();
    }
}