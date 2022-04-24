<?php

require_once "../php/connection.php";
require_once "../php/utils.php";
include "../php/header.php";

$db = new Database();
$func = new functions();

$conn = $db ->connect();

$course = $_GET["name"];

$course_ID = $func ->getCourseID($course);

$_SESSION["course_ID"] = $course_ID;

$counter = 0;


?>

    <div style="margin-left: 42%;margin-top:10%">
        <button type="button" class="btn btn-primary"><a href="announcments.php" class="text-decoration-none" style="color:white">Hirdetmények</a></button>
        <button type="button" class="btn btn-primary">Kurzusfórum</button>
        <button type="button" class="btn btn-primary">Dokumentumok</button>
    </div>

