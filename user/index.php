<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

require_once("../php/utils.php");    
include_once("../php/header.php");    
$utils = new Utils();
$stid = $utils->getUsers();
?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Felhasználók</h2>
                </div>
                <div class="col-xs-6 ml-auto">
                    <a href="./user.php" class="btn btn-success"><span>Új felhasználó</span></a>
                </div>
            </div>
        </div>
        <table class='table table-striped table-dark' >
            <th>Keresztnev</th>
            <th>Vezetéknév</th>
            <th>Felh. típus</th>
            <th>Szemeszter</th>
            <th>Tanítást kezdte</th>
            <th class="text-center">Akció</th>
            <?php
            while ($row = oci_fetch_assoc($stid)) :
                $keresztnev = $row['KERESZTNEV'] !== null ? htmlentities($row['KERESZTNEV'], ENT_QUOTES) : 'ismeretlen';
                $vezeteknev = $row['VEZETEKNEV'] !== null ? htmlentities($row['VEZETEKNEV'], ENT_QUOTES) : 'ismeretlen';
                $startedTeaching = $row['TANITAS_KEZDETE'] !== null ? htmlentities($row['TANITAS_KEZDETE'], ENT_QUOTES) : '';
                $semester = $row['SZEMESZTER'] !== null ? htmlentities($row['SZEMESZTER'], ENT_QUOTES) : '';

                if($row['ADMIN'] == 1) {
                    $typeText = "Admin";
                } else {
                    $type = $utils->determinUserType($row);
                    $typeText = $utils->mapUserTypeTextToUserType($type);
                }

                $disabledIfSelf='';
                if ($_SESSION["userId"] === $row["KOD"]){
                    $typeText .= " (te)";
                    $disabledIfSelf = 'disabled';
                }

                $checkIfAdmin = $row['ADMIN'] == 1 ? 'checked' : '';
                echo "<tr>";
                echo "<td>$keresztnev</td>";
                echo "<td>$vezeteknev</td>";
                echo "<td>$typeText</td>";
                echo "<td>$semester</td>";
                echo "<td>$startedTeaching</td>";
                echo '<td class="text-center">
                <a class="btn btn-warning" href="./user.php?id='.$row['KOD'].'" >Módosít</a>
                <a class="btn btn-danger '.$disabledIfSelf.'" href="./deleteUser.php?id='.$row['KOD'].'">Töröl</a>
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