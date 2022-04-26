<?php
require_once("../php/utils.php");
session_start();


if(!isset($_GET["courseId"]) || !is_numeric($_GET["id"]) || !isset($_GET["studentId"]) || !is_numeric($_GET["studentId"]) ||
(!isset($_SESSION["admin"]) && !isset($_SESSION["student"]))){
    header("location: /");
}

$utils = new Utils();
$stid = $utils->deleteSubscription((int) $_GET["courseId"],(int) $_GET["studentId"]);
header("location: /course/");

