<?php
require_once("../../php/utils.php");
session_start();


if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) || !isset($_SESSION["admin"])){
    header("location: /");
}


$utils = new Utils();
$utils->deleteDoksiById($_GET["id"]);
header("location: /delete/documents.php");