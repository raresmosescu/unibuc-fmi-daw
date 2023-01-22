<?php

include("controllers/view.php");
require("data/order_crud.php");
require("data/order_item_crud.php");

$view = new View;

$view->loadContent("base", "top");
$view->loadContent("content", "checkout");
$view->loadContent("base", "bottom");
