<?php

$tns = "
(DESCRIPTION =
    (ADDRESS_LIST =
      (ADDRESS = (PROTOCOL = TCP)(HOST = localhost)(PORT = 1521))
    )
    (CONNECT_DATA =
      (SID = orania2)
    )
  )";


$username = getenv('szte_oracle_username');
$password = getenv('szte_oracle_password');

$conn = oci_connect("$username", "$password", $tns);
if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['Error'], ENT_QUOTES), E_USER_ERROR);
}

$stid = oci_parse($conn, 'SELECT * FROM tananyag');
oci_execute($stid);

echo "<table border='1'>\n";
while ($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
    echo "<tr>\n";
    foreach ($row as $item) {
        if(is_object($item)){
            echo "    <td>" . "Ez egy Blob" . "</td>\n";
        }else{
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }

    }

    echo "</tr>\n";
}
echo "</table>\n";

?>