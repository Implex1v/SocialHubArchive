#!/usr/bin/php

<?php

require __DIR__ . "/../util/autoload.php";
$handler = new SQLTableHandler();
$handler->createTables();