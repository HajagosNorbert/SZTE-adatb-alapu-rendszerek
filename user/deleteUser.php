<?php
require_once("../php/utils.php");
session_start();

echo "itt vok";
if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

if($_GET["id"] == $_SESSION["userId"]){
    header("location: /user/");
}

$utils = new Utils();
$stid = $utils->deleteUser($_GET["id"]);
header("location: /user/");