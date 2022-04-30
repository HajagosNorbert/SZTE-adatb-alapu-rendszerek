<?php

require_once("../php/utils.php");
session_start();


if(!isset($_GET["epulet_id"]) || !is_numeric($_GET["epulet_id"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

$utils = new Utils();

$buildingId = $_GET["epulet_id"];

$utils->deleteBuilding($buildingId);
header("location: ./");