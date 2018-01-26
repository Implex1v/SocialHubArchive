#!/usr/bin/php
<?php
require __DIR__ . "/classes/util/autoload.php";
require __DIR__ . "/classes/ApplicationController.php";

$controller = new ApplicationController();
$controller->fetchAll();

file_put_contents(__DIR__ . "/log/log.log", date("d.m.Y H:i") . " fetched data\n", FILE_APPEND);