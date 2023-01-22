<?php


require("controllers/view.php");
require ("data/user_crud.php");
require ("data/order_crud.php");

$view = new View;

// get htdocs path
// echo $_SERVER['DOCUMENT_ROOT'];

$view->loadContent("base", "top");
$view->loadContent("content", "orders");
$view->loadContent("base", "bottom");