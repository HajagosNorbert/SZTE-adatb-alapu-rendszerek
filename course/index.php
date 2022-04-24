<?php 
session_start();
require_once("../php/connection.php");
include_once("../php/header.php");


$db = new Database();

$conn = $db ->connect();
$counter = 0;


$kod = $_SESSION["userId"];

$sql = "SELECT kurzus.nev FROM kurzus INNER JOIN feliratkozas ON kurzus.kod = feliratkozas.kurzus_kod 
                                                               INNER JOIN hallgato on feliratkozas.hallgato_kod = hallgato.felhasznalo_kod
                                                               INNER JOIN felhasznalo on hallgato.felhasznalo_kod = felhasznalo.kod
                                                               WHERE felhasznalo.kod = $kod";

$stid = oci_parse($conn, $sql);
oci_execute($stid);

echo "<div style='margin-left: 37%'>".
     "<table class='table table-striped table-dark' style='width: 40%;text-align: center'>";

echo "<th>Kurzus neve</th></tr>";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {


    echo "<tr>";
    foreach ($row as $item) {
        echo "    <td><a style='color: white' href='course.php?name=$item'>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . ".</a></td>";
        $counter++;
    }
    echo "</tr>";

}
if($counter == 0){
    echo "<td>Még nem vettél fel egy kurzust sem!</td>";
}
echo "</table>".
     "</div>";
?>
