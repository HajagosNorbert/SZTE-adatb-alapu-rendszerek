<?php
include_once("../php/utils.php");
session_start();

if(!isset($_GET["courseId"]) || !is_numeric($_GET["courseId"]) || !isset($_SESSION["teacher"])){
  header("location: ./");
}

$utils = new Utils();
$utils -> unsubscribeFromCourseAsTeacher($_GET["courseId"]);

header("location: ./");
