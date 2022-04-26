<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

require_once("../php/utils.php");
include_once("../php/header.php");
$utils = new Utils();
$stid = $utils->getDoksik();


?>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row" style="margin: 15px 0">
                    <div class="col-xs-6">
                        <h2>Kurzusok</h2>
                    </div>
                </div>
            </div>
            <table class='table table-striped table-dark' >
                <th>Kurzus neve</th>
                <th class="text-center">Akció</th>
                <?php
                while ($row = oci_fetch_assoc($stid)) :
                    $doksi = $row['NEV'] !== null ? htmlentities($row['NEV'], ENT_QUOTES) : 'nincs doksi még';


                    echo "<tr>";
                    echo "<td>$doksi</td>";
                    echo '<td class="text-center">
                <a class="btn btn-danger" href="delete_execute/documentDelete.php?id='.$row['KOD'].'">Töröl</a>
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