<?php

require_once("../php/utils.php");
session_start();


if(!isset($_POST["saveBuilding"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

$utils = new Utils();

$buildingName = trim($_POST["epuletNev"]);
$buildingId = trim($_POST["epuletKod"]);

$utils->createBuilding($buildingName,$buildingId);
header("location: ./");
