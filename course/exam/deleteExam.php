<?php
require_once("../../php/utils.php");
session_start();

if(!isset($_GET["id"]) || !is_numeric($_GET["id"]) ){
    header("location: /");
}
echo $_GET["id"];

$utils = new Utils();

// $stid = $utils -> getExamById($_GET["id"]);
// $examCount = oci_fetch_all($stid, $exams, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

// $courseId = ($bejegyzesCount)? $exams[0]["KOD"] : '0';

$utils -> deleteExamById($_GET["id"]);


header("location: /course/exam/");

