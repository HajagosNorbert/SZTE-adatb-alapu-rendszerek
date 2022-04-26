<?php 
session_start();
require_once "../php/connection.php";
require_once "../php/utils.php";
include_once "../php/header.php";

if(!isset($_SESSION["userId"])){
    header("location: /");
}

if(!isset($_GET["courseId"]) || !is_numeric($_GET["courseId"])){
    header("location: /course/");
}
$courseId = $_GET["courseId"];
$utils = new Utils();

//get the course by id and redirect if there issn't one
$courseStid = $utils->getCourseById((int) $courseId);
if(!oci_fetch_all($courseStid, $courses, 0, -1, OCI_FETCHSTATEMENT_BY_ROW)){
    header("location: /course/");
}
$course = $courses[0];
$courseName = $course['NEV'] !== null ? htmlentities($course['NEV'], ENT_QUOTES) : 'Ismeretlen nevű kurzus';
$stid = $utils ->getCourseById($courseId);

?>
<div class="row" style="margin: 35px 0;">
      <div class="col-xs-6">
          <h2><?= $courseName ?></h2>
      </div>
      <div class="col-xs-6 ml-auto">
      </div>
  </div>
<div style="margin-left: 42%;margin-top:10%">
    <a href="./announcments.php?courseId=<?= $courseId ?>" class="text-decoration-none" style="color:white"><button type="button" class="btn btn-primary">Hirdetmények</button></a>
    <a href="./forum.php?courseId=<?= $courseId ?>" class="text-decoration-none" style="color:white"><button type="button" class="btn btn-primary">Kurzusfórum</button></a>
    <a href="./documents.php?courseId=<?= $courseId ?>" class="text-decoration-none" style="color:white"><button type="button" class="btn btn-primary">Dokumentumok</button></a>
</div>
<?php
include_once "../php/footer.php";
?>