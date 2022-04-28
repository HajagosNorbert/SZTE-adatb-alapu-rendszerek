<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

require_once("../../php/utils.php");
include_once("../../php/header.php");
$utils = new Utils();
$stid = $utils->getExams();


?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Vizsgák</h2>
                </div>
            </div>
        </div>
        <table class='table table-striped table-dark' >
            <th>Kurzus neve</th>
            <th>Időpont</th>
            <th>Helyszín</th>
            <th class="text-center">Akció</th>
            <?php
            while ($row = oci_fetch_assoc($stid)) :
                $time = $row['IDOPONT'] !== null ? htmlentities($row['IDOPONT'], ENT_QUOTES) : 'Nincs meghírdetve';
                $room = $row['TEREM_KOD'] !== null ? htmlentities($row['TEREM_KOD'], ENT_QUOTES) : '';

                $building = $row['EPULET_NEV'] !== null ? htmlentities($row['EPULET_NEV'], ENT_QUOTES) : '';
                $courseName = $row['KURZUS_NEV'] !== null ? htmlentities($row['KURZUS_NEV'], ENT_QUOTES) : '';

                $location = "$room, $building";


                echo "<tr>";
                echo "<td>$courseName</td>";
                echo "<td>$time</td>";
                echo "<td>$location</td>";
                echo '<td class="text-center">
                <a class="btn btn-danger" href="./deleteExam.php?id='.$row['KOD'].'">Töröl</a>
                </td>';

                echo "</tr>";
            endwhile;
            ?>
        </table>
    </div>
</div>

<?php
include_once("../../php/footer.php");
?>
