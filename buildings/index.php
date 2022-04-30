<?php
session_start();

if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

require_once("../php/utils.php");
include_once("../php/header.php");
$utils = new Utils();
$stid = $utils->getBuildings();


?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Épületek</h2>
                </div>
                <div class="col-xs-6 ml-auto">
                    <a href="./buildingForm.php" class="btn btn-success"><span>Új épület</span></a>
                </div>
            </div>
        </div>
        <table class='table table-striped table-dark' >
            <th>Épület neve</th>
            <th>Összes terem</th>
            <th class="text-center">Akció</th>
            <?php
            while ($row = oci_fetch_assoc($stid)) :
                $epuletNeve = $row['NEV'] !== null ? htmlentities($row['NEV'], ENT_QUOTES) : '';
                $darab = $row['darab'] !== null ? htmlentities($row['darab'], ENT_QUOTES) : '';


                echo "<tr>";
                echo "<td>$epuletNeve</td>";
                echo "<td>$darab</td>";
                echo '<td class="text-center">
                <a class="btn btn-warning" href="./buildingForm.php?epulet_id='.$row['epulet_id'].'">Épület módosítása</a>
                <a class="btn btn-danger" href="./deleteBuilding.php?epulet_id='.$row['epulet_id'].'">Töröl</a>
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

