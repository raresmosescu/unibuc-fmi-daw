<?php

include("controllers/view.php");

$view = new View;

$view->loadContent("base", "top");
$view->loadContent("content", "checkout");
$view->loadContent("base", "bottom");
