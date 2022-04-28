<?php 
session_start();
require_once "../../php/connection.php";
require_once "../../php/utils.php";
include_once "../../php/header.php";

$noAnouncementsFound = false;
$utils = new Utils();
if(!isset($_GET["courseId"]) || !is_numeric($_GET["courseId"])){
    header("location: /course/");
}


//get the course by id and redirect if there issn't one
$courseStid = $utils->getCourseById((int) $_GET["courseId"]);
if(!oci_fetch_all($courseStid, $courses, 0, -1, OCI_FETCHSTATEMENT_BY_ROW)){
    header("location: /course/");
}

$stid = $utils->getAnnouncmentsByCourseId((int) $_GET["courseId"]);
if(!oci_fetch_all($stid, $rows, 0, -1, OCI_FETCHSTATEMENT_BY_ROW)){
    $noAnouncementsFound = true;
}


echo "<div style='margin-left: 37%'>".
    "<table class='table table-striped table-dark' style='width: 40%;text-align: center'>";

echo "<th>Hirdetmények</th>";
if(isset($_SESSION["teacher"])){
    echo "<th>Akció</th>";
}


    foreach ($rows as $item) {
        $tartalom = $item['TARTALOM'] !== null ? htmlentities($item['TARTALOM'], ENT_QUOTES) : 'nincs hirdetémy a kurzushoz';

        echo "<tr>";
        echo "<td>$tartalom</td>";
        if( isset($_SESSION["admin"]) || $item["FELHASZNALO_KOD"] == $_SESSION["userId"]){

            echo '<td class="text-center">
                <a class="btn btn-danger" href="./deleteAnnouncment.php?id='.$item['KOD'].'">Töröl</a>
                </td>';
        }
        echo "</tr>";
    }



if($noAnouncementsFound){
    echo "<td>A hirdetményekhez még nem írtak</td>";
}
echo "</table>".
    "</div>";

include_once "../../php/footer.php";
?>