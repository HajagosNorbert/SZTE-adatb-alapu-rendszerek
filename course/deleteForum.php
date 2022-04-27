<?php
require_once("../php/utils.php");
session_start();

if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) ){
    header("location: /");
}

$utils = new Utils();
$stid = $utils -> getBejegyzesById($_GET["id"]);
$bejegyzesCount = oci_fetch_all($stid, $bejegyzesek, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
$courseId = ($bejegyzesCount)? $bejegyzesek[0]["KOD"] : '0';
$utils -> deleteBejegyzesById($_GET["id"]);


header("location: /course/forum.php?courseId=$courseId");

