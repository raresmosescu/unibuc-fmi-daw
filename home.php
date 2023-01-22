<?php


require("controllers/view.php");
require("data/product_crud.php");

$view = new View;

// get htdocs path
// echo $_SERVER['DOCUMENT_ROOT'];

$view->loadContent("base", "top");
$view->loadContent("content", "home");
$view->loadContent("base", "bottom");
