<?php
session_start();

if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

require_once("../php/utils.php");
include_once("../php/header.php");
$utils = new Utils();
$stid = $utils->getRoomsAndBuildings();


?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Termek</h2>
                </div>
                <div class="col-xs-6 ml-auto">
                    <a href="./roomForm.php" class="btn btn-success"><span>Új terem</span></a>
                </div>
            </div>
        </div>
        <table class='table table-striped table-dark' >
            <th>Terem neve</th>
            <th>Épület neve</th>
            <th class="text-center">Akció</th>
            <?php
            while ($row = oci_fetch_assoc($stid)) :
                $teremKod = $row['terem_kod'] ?? 0;
                $teremKodText = ($teremKod)?: 'Nincs terem hozzárendelve';
                $teremNev = $row['terem_nev'] !== null ? ', '.htmlentities($row['terem_nev'], ENT_QUOTES) : '';
                $epulet = $row['epulet_nev'] !== null ? htmlentities($row['epulet_nev'], ENT_QUOTES) : 'nincs épület hozzárendelve';

                echo "<tr>";
                echo "<td>$teremKodText$teremNev</td>";
                echo "<td>$epulet</td>";
                echo '<td class="text-center">
                <a class="btn btn-warning" href="./roomForm.php?terem_id='.$teremKod.'&epulet_id='.$row['epulet_kod'].'">Terem módosítása</a>
                <a class="btn btn-danger" href="./deleteRoom.php?terem_id='.$teremKod.'&epulet_id='.$row['epulet_kod'].'">Töröl</a>
                </td>';

                echo "</tr>";
            endwhile;
            ?>
        </table>
    </div>
</div>

<?php
include_once("../php/footer.php");
?>
