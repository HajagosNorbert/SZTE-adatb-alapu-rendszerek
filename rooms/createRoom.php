<?php

require_once("../php/utils.php");
session_start();


if(!isset($_POST["saveRoom"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

$kod = trim($_POST["teremKod"]);
$nev = trim($_POST["teremNev"]);
$epuletKod = trim($_POST["epuletKod"]);

$utils = new Utils();

$utils->createRoom($kod,$nev,$epuletKod);


header("location: ./");


