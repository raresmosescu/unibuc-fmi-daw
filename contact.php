<?php


require("controllers/view.php");
require("utility/email.php");

$view = new View;

// get htdocs path
// echo $_SERVER['DOCUMENT_ROOT'];

$view->loadContent("base", "top");
$view->loadContent("content", "contact");
$view->loadContent("base", "bottom");
