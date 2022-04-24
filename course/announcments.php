<?php

require_once "../php/connection.php";
require_once "../php/utils.php";
include "../php/header.php";

$db = new Database();
$func = new functions();

$conn = $db ->connect();


$course_ID = $_SESSION["course_ID"];
$counter = 0;

$sql = "SELECT tartalom FROM hirdetmeny WHERE kurzus_kod = $course_ID";


$announcements = oci_parse($conn, $sql);
oci_execute($announcements);

echo "<div style='margin-left: 37%'>".
    "<table class='table table-striped table-dark' style='width: 40%;text-align: center'>";

echo "<th>Hirdetmények</th></tr>";
while ($row = oci_fetch_array($announcements, OCI_ASSOC+OCI_RETURN_NULLS)) {


    echo "<tr>";
    foreach ($row as $item) {
        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>";
        $counter++;
    }
    echo "</tr>";

}
if($counter == 0){
    echo "<td>A hirdetményekhez még nem írtak</td>";
}
echo "</table>".
    "</div>";

?>
