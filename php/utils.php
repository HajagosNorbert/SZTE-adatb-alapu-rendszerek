<?php
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
        
        $sql = "SELECT kod, jelszo, keresztnev, vezeteknev, admin, szemeszter, hallgato.felhasznalo_kod as hallgato_kod, TO_CHAR(tanitas_kezdete, 'YYYY-MM-DD HH24:MI') as tanitas_kezdete, oktato.felhasznalo_kod as oktato_kod
        FROM felhasznalo
        left join hallgato on  hallgato.felhasznalo_kod = felhasznalo.kod
        left join oktato on oktato.felhasznalo_kod = felhasznalo.kod
        where felhasznalo.kod = :userId";

        // $sql = "SELECT kod, jelszo, keresztnev, vezeteknev, admin, szemeszter, hallgato.felhasznalo_kod as hallgato_kod, tanitas_kezdete, oktato.felhasznalo_kod as oktato_kod
        // FROM felhasznalo
        // left join hallgato on  hallgato.felhasznalo_kod = felhasznalo.kod
        // left join oktato on oktato.felhasznalo_kod = felhasznalo.kod
        // where felhasznalo.kod = :userId";

        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":userId", $userId);
        oci_execute($stid);
        return $stid;
    }

    public function getUsers()
    {
        
        $sql = "SELECT kod, jelszo, keresztnev, vezeteknev, admin, szemeszter, hallgato.felhasznalo_kod as hallgato_kod, TO_CHAR(tanitas_kezdete, 'YYYY-MM-DD HH24:MI') as tanitas_kezdete, oktato.felhasznalo_kod as oktato_kod 
        FROM felhasznalo        
        left join hallgato on  hallgato.felhasznalo_kod = felhasznalo.kod 
        left join oktato on oktato.felhasznalo_kod = felhasznalo.kod";
        /*
        $sql = "SELECT kod, jelszo, keresztnev, vezeteknev, admin, szemeszter, hallgato.felhasznalo_kod as hallgato_kod, tanitas_kezdete, oktato.felhasznalo_kod as oktato_kod
        FROM felhasznalo
        left join hallgato on  hallgato.felhasznalo_kod = felhasznalo.kod
        left join oktato on oktato.felhasznalo_kod = felhasznalo.kod";
        */
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);
        return $stid;
    }

    public function deleteUser($userId)
    {
        $sql = "delete FROM felhasznalo where felhasznalo.kod = :userId
        ";

        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":userId", $userId);
        oci_execute($stid);
        return $stid;
    }
    
//========================================================
//===================== NEM ADATBAZIS ====================
//========================================================

    public function determinUserType($user): string{
        if($user['HALLGATO_KOD'] !== null && $user['OKTATO_KOD'] !== null)
           return "phd";
        if($user['HALLGATO_KOD'] !== null && $user['OKTATO_KOD'] === null)
            return "hallgato";
        if($user['HALLGATO_KOD'] === null && $user['OKTATO_KOD'] !== null)
            return "oktato";
        return "inaktiv";
    }

    public function mapUserTypeTextToUserType($userType): string{
        if($userType === "phd")
            return "PHD";
        if($userType === "oktato")
            return "Oktató";
        if($userType === "hallgato")
            return "Hallgató";
        if($userType === "inaktiv")
            return "Inaktív";
    }
}

