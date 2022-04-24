<?php
session_start();
require_once "connection.php";

class Utils{
    private $conn;


    function __construct() {
        $this->conn =  (new Database()) -> connect();
    }


    public function getCourseID($course): int
    {
        $sql = "select kod from kurzus where nev = '$course'";


        $stid = oci_parse($this->conn,$sql);
        oci_execute($stid);

        $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);

        if(!empty($row)){
            return (int)$row["KOD"];
        }
        return 0;
    }

    public function getUserById($userId)
    {
        $sql = "SELECT kod, jelszo, keresztnev, vezeteknev, admin, szemeszter, hallgato.felhasznalo_kod as hallgato_kod, tanitas_kezdete, oktato.felhasznalo_kod as oktato_kod
        FROM felhasznalo
        left join hallgato on  hallgato.felhasznalo_kod = felhasznalo.kod
        left join oktato on oktato.felhasznalo_kod = felhasznalo.kod
        where felhasznalo.kod = :userId";

        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":userId", $userId);
        oci_execute($stid);
        return $stid;
    }
    
}

