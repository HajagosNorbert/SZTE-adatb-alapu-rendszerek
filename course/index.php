<?php 
session_start();
require_once("../php/utils.php");
include_once("../php/header.php");

if(!isset($_SESSION["userId"])){
    header("location: /");
}

$utils = new Utils();
$stid = $utils->getSubscribedCoursesByUserId($_SESSION["userId"]);

$coursesCount = oci_fetch_all($stid, $courses, 0, -1, OCI_FETCHSTATEMENT_BY_ROW);
?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Kurzusok</h2>
                </div>
                <div class="col-xs-6 ml-auto">
                    <a href="./user.php" class="btn btn-success"><span>Új Kurzus</span></a>
                </div>
            </div>
        </div>
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
                    
                <?php if(isset($_SESSION["student"]) && $_SESSION["userId"] != $row["OKTATO_KOD"]): ?>
                    <a class="btn btn-danger" href="./unsubscribeFromCourseAsStudent.php?courseId=<?= $row['KOD'] ?>&studentId=<?= $_SESSION["userId"]?>" >Lejelentkezés</a>
                <?php endif; ?>
                
                <?php if(isset($row["OKTATO_KOD"]) && $_SESSION["userId"] == $row["OKTATO_KOD"] && isset($_SESSION["teacher"])): ?>

                    <a class="btn btn-danger" href="./unsubscribeFromCourseAsTeacher.php?courseId=<?= $row['KOD'] ?>">Tanítás Leadása</a>

                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<?php
include_once("../php/footer.php");
?>

