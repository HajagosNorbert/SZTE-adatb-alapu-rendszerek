<?php

require_once("../php/utils.php");
session_start();


if(!isset($_POST["saveBuilding"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

$utils = new Utils();

$buildingName = trim($_POST["epuletNev"]);


$utils->createBuilding($buildingName);
header("location: ./");
