<?php
include_once("../php/utils.php");
session_start();

if(!isset($_GET["courseId"]) || !is_numeric($_GET["courseId"]) || !isset($_SESSION["student"])){
  header("location: ./");
}

$utils = new Utils();
$utils -> createSubscription($_GET["courseId"], $_SESSION["userId"]);

header("location: ./");
