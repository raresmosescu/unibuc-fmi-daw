<?php

require("controllers/view.php");
require('data/database.php');

$view = new View;

// get htdocs path
// echo $_SERVER['DOCUMENT_ROOT'];

$view->loadContent("base", "top");
$view->loadContent("content", "thankyou");
$view->loadContent("base", "bottom");
