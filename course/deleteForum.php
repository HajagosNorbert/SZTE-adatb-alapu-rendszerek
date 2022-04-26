<?php
require_once("../php/utils.php");
session_start();

if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) ){
    header("location: /");
}

$utils = new Utils();
$utils -> deleteBejegyzesById($_GET["id"]);

header("location: /course/forum.php");

