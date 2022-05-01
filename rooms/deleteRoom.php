<?php

require_once("../php/utils.php");
session_start();


if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

$utils = new Utils();



$utils->deleteRoomById($_GET["terem_id"],$_GET["epulet_id"]);
header("location: ./");







