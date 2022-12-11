<?php

include("models/product.php");

include("controllers/view.php");

$view = new View;

$view->loadContent("base", "top");
$view->loadContent("content", "home");
$view->loadContent("base", "bottom");
