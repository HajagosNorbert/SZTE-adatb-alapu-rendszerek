<?php
require_once("../php/utils.php");
session_start();

if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) || !isset($_SESSION["admin"])){
  header("location: /");
}

$utils = new Utils();
$stid = $utils->deleteUser($_GET["userId"]);
header("location: /user/");

