<?php
require_once("../../php/utils.php");
session_start();

if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) ){
  header("location: /");
}

$utils = new Utils();
$utils -> deleteAnnouncmentById($_GET["id"]);

header("location: ./");

