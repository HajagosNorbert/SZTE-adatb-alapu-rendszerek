<?php 
session_start();
require_once("../php/utils.php");
include_once("../php/header.php");

if(!isset($_SESSION["userId"])){
    header("location: /");
}
function coursesEqual($course){
    global $subscribedCourses;
    foreach ($subscribedCourses as $courseNotToInclude){
        if ($course["KOD"] == $courseNotToInclude["KOD"]){
            return false;
        }
    }
    return true;
}



function print_table($courses, $isSubscribedTable){
?>
<table class='table table-striped table-dark' >
    <th>Név</th>
    <th>Létszám</th>
    <th>Oktató</th>
    <th class="text-center">Akció</th>
    <?php
    foreach ($courses as $row) :
        $courseId = $row["KOD"];
        $courseName = $row['NEV'] !== null ? htmlentities($row['NEV'], ENT_QUOTES) : 'ismeretlen';
        $studentCount = $row['LETSZAM'] !== null ? htmlentities($row['LETSZAM'], ENT_QUOTES) : '0'; 
        $maxStudentCount = $row['MAX_LETSZAM'] !== null ? htmlentities($row['MAX_LETSZAM'], ENT_QUOTES) : 'Korlátlan';
        $teacherLastname = $row['OKTATO_VEZETEKNEV'] !== null ? htmlentities($row['OKTATO_VEZETEKNEV'], ENT_QUOTES) : null;
        $teacherFirstname = $row['OKTATO_KERESZTNEV'] !== null ? htmlentities($row['OKTATO_KERESZTNEV'], ENT_QUOTES) : null;

        $teacherNameText = (isset($teacherFirstname) && isset($teacherLastname))? $teacherFirstname." ".$teacherLastname : "Jelenleg nincs oktató";
        ?>

        <tr>
        <td><a href="./course.php?courseId=<?= $courseId ?>"><?=$courseName?></a></td>
        <td><?="$studentCount / $maxStudentCount"?></td>
        <td><?=$teacherNameText?></td>
        <td class="text-center">
            
        <?php if($isSubscribedTable && isset($_SESSION["student"]) && $_SESSION["userId"] != $row["OKTATO_KOD"]): ?>
            <a class="btn btn-danger" href="./unsubscribeFromCourseAsStudent.php?courseId=<?= $row['KOD'] ?>&studentId=<?= $_SESSION["userId"]?>" >Lejelentkezés</a>
        <?php endif; ?>
        <?php if($isSubscribedTable && isset($row["OKTATO_KOD"]) && $_SESSION["userId"] == $row["OKTATO_KOD"] && isset($_SESSION["teacher"])): ?>
            <a class="btn btn-danger" href="./unsubscribeFromCourseAsTeacher.php?courseId=<?= $row['KOD'] ?>">Tanítás Leadása</a>
        <?php endif; ?>

        <?php if(!$isSubscribedTable && !isset($row["OKTATO_KOD"]) && isset($_SESSION["teacher"])): ?>
            <a class="btn btn-success" href="./subscribeToCourseAsTeacher.php?courseId=<?= $row['KOD'] ?>">Tanítás Vállalása</a>
        <?php endif; ?>
        
        <?php if(!$isSubscribedTable && isset($_SESSION["student"])): ?>
            <a class="btn btn-success" href="./subscribeToCourseAsStudent.php?courseId=<?= $row['KOD'] ?>">Kurzus Felvétele</a>
        <?php endif; ?>

        <?php if(isset($_SESSION["admin"])): ?>
                
            <a class="btn btn-warning" href="./courseForm.php?id=<?= $row['KOD'] ?>">Módosítás</a>
            <a class="btn btn-danger" href="./deleteCourse.php?id=<?= $row['KOD'] ?>">Törlés</a>

        <?php endif; ?>



    </tr>
    <?php endforeach; ?>
</table>

<?php
}



$utils = new Utils();
$stidSubscribedCourses = $utils->getSubscribedCoursesByUserId($_SESSION["userId"]);
oci_fetch_all($stidSubscribedCourses, $subscribedCourses, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);

$stidAllCourses = $utils->getCoursesWithStudentCount();
oci_fetch_all($stidAllCourses, $allCourses, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
$coursesNotSubscribedTo = array_filter($allCourses, "coursesEqual");

?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Felíratkozott kurzusok</h2>
                </div>
                <div class="col-xs-6 ml-auto">
                    <a href="./courseForm.php" class="btn btn-success"><span>Új Kurzus</span></a>
                </div>
            </div>
        </div>
        <?php
            print_table($subscribedCourses, true);
        ?>
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Egyéb Kurzusok</h2>
                </div>
            </div>
        </div>
        <hr>
        <?php
            print_table($coursesNotSubscribedTo, false);
        ?>
    </div>
</div>

<?php
include_once("../php/footer.php");
?>