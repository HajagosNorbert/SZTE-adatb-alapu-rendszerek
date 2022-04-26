<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

require_once("../php/utils.php");
include_once("../php/header.php");
$utils = new Utils();
$stid = $utils->getLogs();


?>
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row" style="margin: 15px 0">
                <div class="col-xs-6">
                    <h2>Logok</h2>
                </div>
            </div>
        </div>
        <table class='table table-striped table-dark' >
            <th>Vezetéknév</th>
            <th>Keresztnév</th>
            <th>Belépési idő</th>
            <th class="text-center">Akció</th>
            <?php
            while ($row = oci_fetch_assoc($stid)) :
                $vezeteknev = $row['VEZETEKNEV'] !== null ? htmlentities($row['VEZETEKNEV'], ENT_QUOTES) : 'nincs vezetékneve';
                $keresztnev = $row['KERESZTNEV'] !== null ? htmlentities($row['KERESZTNEV'], ENT_QUOTES) : 'nincs keresztneve';
                $loginTime = $row['BEJELENTKEZESI_IDO'] !== null ? htmlentities($row['BEJELENTKEZESI_IDO'], ENT_QUOTES) : 'a felhasználó még nem lépett be';


                echo "<tr>";
                echo "<td>$vezeteknev</td>";
                echo "<td>$keresztnev</td>";
                echo "<td>$loginTime</td>";
                echo '<td class="text-center">
                <a class="btn btn-danger" href="delete_execute/deleteLog.php?id='.$row['KOD'].'">Töröl</a>
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
