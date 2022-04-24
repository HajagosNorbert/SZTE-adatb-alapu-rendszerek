<?php
session_start();
require_once("../php/utils.php");    
include_once("../php/header.php");    
$utils = new Utils();
$stid = $utils->getUsers();
?>
<div >
    <form action="./deleteUser.php" method="post">
        <table class='table table-striped table-dark' >
            <th>Keresztnev</th>
            <th>Vezetéknév</th>
            <th>Felh. típus</th>
            <th>Szemeszter</th>
            <th>Tanítást kezdte</th>
            <th>Akció</th>
            <?php
            while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) :
                $keresztnev = $row['KERESZTNEV'] !== null ? htmlentities($row['KERESZTNEV'], ENT_QUOTES) : 'ismeretlen';
                $vezeteknev = $row['VEZETEKNEV'] !== null ? htmlentities($row['VEZETEKNEV'], ENT_QUOTES) : 'ismeretlen';
                $startedTeaching = $row['TANITAS_KEZDETE'] !== null ? htmlentities($row['TANITAS_KEZDETE'], ENT_QUOTES) : '';
                $semester = $row['SZEMESZTER'] !== null ? htmlentities($row['SZEMESZTER'], ENT_QUOTES) : '';

                if($row['ADMIN'] == 1) {
                    $type = "Admin";
                } else if($row['HALLGATO_KOD'] !== null && $row['OKTATO_KOD'] !== null){
                    $type = "PHD";
                } else if($row['HALLGATO_KOD'] !== null && $row['OKTATO_KOD'] === null){
                    $type = "Hallgató";
                } else if($row['HALLGATO_KOD'] === null && $row['OKTATO_KOD'] !== null){
                    $type = "Oktató";
                } else {
                    $type = "Inaktív";
                }

                $disabledIfSelf='';
                if ($_SESSION["userId"] === $row["KOD"]){
                    $vezeteknev .= " (te)";
                    $disabledIfSelf = 'disabled';
                }

                $checkIfAdmin = $row['ADMIN'] == 1 ? 'checked' : '';
                echo "<tr>";
                echo "<td>$keresztnev</td>";
                echo "<td>$vezeteknev</td>";
                echo "<td>$type</td>";
                echo "<td>$semester</td>";
                echo "<td>$startedTeaching</td>";
                echo '<td><button type="submit" class="btn btn-danger" value="'.$row['KOD'].'" name="userId" '.$disabledIfSelf.'>Törlés</button></td>';

                echo "</tr>";
                endwhile;
            ?>
        </table>
    </form>

</div>

<?php 
include_once("../php/footer.php");    
?>