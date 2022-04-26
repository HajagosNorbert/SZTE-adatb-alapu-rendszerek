<?php
require_once("../php/utils.php");
session_start();

if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

if($_GET["userId"] == $_SESSION["userId"]){
    header("location: /user/");
}
$utils = new Utils();
$stid = $utils->deleteUser($_GET["userId"]);
header("location: /user/");

