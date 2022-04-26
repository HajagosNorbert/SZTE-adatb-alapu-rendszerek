<?php
require_once("../../php/utils.php");
session_start();


if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) || !isset($_SESSION["admin"])){
    header("location: /");
}


$utils = new Utils();

$countBuilding = $utils -> countBuildingById($_GET["epulet_id"]);
$row = oci_fetch_assoc($countBuilding);

$countResult = (int)$row["darab"];

$utils->deleteRoomById($_GET["terem_id"],$_GET["epulet_id"]);

if($countResult == 0){

    $utils -> deleteBuildingById($_GET["epulet_id"]);
}
header("location: /delete/courses.php");







