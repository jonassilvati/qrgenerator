<?php

require_once "..".DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR."autoload.php";
require_once "..".DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."phpqrcode".DIRECTORY_SEPARATOR."qrlib.php";

$param = $_GET['id']; // remember to sanitize that - it is user input!

// we need to be sure ours script does not output anything!!!
// otherwise it will break up PNG binary!

ob_start("callback");

// here DB request or some processing
$codeText = 'demo -'.$param;

// end of processing here
$debugLog = ob_get_contents();
ob_end_clean();

// outputs image directly into browser, as PNG stream
QRcode::png($codeText);