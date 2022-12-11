<?php

include("controllers/view.php");

$view = new View;

$view->loadContent("base", "top");
$view->loadContent("content", "cart");
$view->loadContent("base", "bottom");
