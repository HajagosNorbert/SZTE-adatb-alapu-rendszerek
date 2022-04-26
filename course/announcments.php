<?php 
session_start();
require_once "../php/connection.php";
require_once "../php/utils.php";
include "../php/header.php";

$rows = [];
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
    echo"Nincs hírdetmény ehhez az courseId-hoz";
}


echo "<div style='margin-left: 37%'>".
    "<table class='table table-striped table-dark' style='width: 40%;text-align: center'>";

echo "<th>Hirdetmények</th></tr>";
foreach ($rows as $row) {

    echo "<tr>";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>";
    }
    echo "</tr>";

}
if($noAnouncementsFound){
    echo "<td>A hirdetményekhez még nem írtak</td>";
}
echo "</table>".
    "</div>";

?>
