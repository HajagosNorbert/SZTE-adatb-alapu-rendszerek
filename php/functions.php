<?php
session_start();
require_once "connection.php";

class functions{


    public function getCourseID($course): int
    {
        $db = new Database();
        $conn = $db -> connect();


        $sql = "select kod from kurzus where nev = '$course'";


        $stid = oci_parse($conn,$sql);
        oci_execute($stid);

        $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

        if(!empty($row)){
            return (int)$row["KOD"];
        }

        return 0;

    }
}

