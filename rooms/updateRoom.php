<?php

require_once("../php/utils.php");
session_start();


if(!isset($_POST["saveRoom"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

$teremNev = trim($_POST["teremNev"]);
$ujTeremKod = trim($_POST["teremKod"]);
$ujEpuletKod = trim($_POST["epuletKod"]);

$regiTeremKod = $_GET["terem_id"];
$epuletId = $_GET["epulet_id"];

$utils = new Utils();


$utils->updateRoom($ujTeremKod,$teremNev,$regiTeremKod,$epuletId,$ujEpuletKod);


header("location: ./");
