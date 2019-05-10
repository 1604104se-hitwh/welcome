<?php
define("ROOT",dirname(__DIR__));
set_include_path(
    ".".PATH_SEPARATOR.ROOT."/include/data".
    PATH_SEPARATOR.ROOT."/include/src".
    PATH_SEPARATOR.get_include_path());

require_once("Checker.php");
require_once("Generator.php");
require_once("Helper.php");
require_once("IdValidator.php");
require_once("addressCode.php");
require_once("addressCodeTimeline.php");
require_once("chineseZodiac.php");
require_once("constellation.php");



