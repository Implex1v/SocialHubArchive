<?php
/**
 * Created by PhpStorm.
 * User: Implex1v
 * Date: 27.01.18
 * Time: 11:56
 */

require __DIR__ . "/classes/util/autoload.php";
require __DIR__ . "/classes/ApplicationController.php";

$controller = new ApplicationController();
$controller->readTwitchId("gronkh");