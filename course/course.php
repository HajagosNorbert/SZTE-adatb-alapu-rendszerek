<?php 
session_start();
require_once "../php/connection.php";
require_once "../php/utils.php";
include "../php/header.php";

$utils = new Utils();

$stid = $utils ->getCourseById($_GET["courseId"]);

?>

    <div style="margin-left: 42%;margin-top:10%">
        <button type="button" class="btn btn-primary"><a href="announcments.php" class="text-decoration-none" style="color:white">Hirdetmények</a></button>
        <button type="button" class="btn btn-primary">Kurzusfórum</button>
        <button type="button" class="btn btn-primary">Dokumentumok</button>
    </div>

