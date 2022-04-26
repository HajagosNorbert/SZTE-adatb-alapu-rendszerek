<?php
require_once "connection.php";

class Utils{
    private $conn;


    function __construct() {
        $this->conn =  (new Database()) -> connect();
    }

    public function getCourseById($courseId)
    {
        $sql = "select * from kurzus where kod = :courseId";


        $stid = oci_parse($this->conn,$sql);
        oci_bind_by_name($stid, ":courseId", $courseId);
        oci_execute($stid);
        return $stid;
    }

    public function getAnnouncmentsByCourseId($courseId)
    {
        $sql = "SELECT tartalom FROM hirdetmeny WHERE kurzus_kod = :courseId";


        $stid = oci_parse($this->conn,$sql);
        oci_bind_by_name($stid, ":courseId", $courseId);
        oci_execute($stid);
        return $stid;
    }


    public function getSubscribedCoursesByUserId($userId)
    {

        $sql = "select kurzus.kod, kurzus.nev, kurzus.max_letszam, count(kurzus.nev) AS letszam, f2.kod as oktato_kod, f2.keresztnev as oktato_keresztnev, f2.vezeteknev as oktato_vezeteknev
        from kurzus 
        inner join feliratkozas on kurzus.kod = feliratkozas.kurzus_kod 
        inner join felhasznalo on feliratkozas.hallgato_kod = felhasznalo.kod
        inner join felhasznalo f2 on kurzus.oktato_kod = f2.kod
        where kurzus.oktato_kod = :userId or kurzus.kod in (
        SELECT kurzus.kod FROM kurzus INNER JOIN feliratkozas ON kurzus.kod = feliratkozas.kurzus_kod 
                 INNER JOIN hallgato on feliratkozas.hallgato_kod = hallgato.felhasznalo_kod
                 INNER JOIN felhasznalo on hallgato.felhasznalo_kod = felhasznalo.kod
                 WHERE felhasznalo.kod = :userId
        )
        group by kurzus.kod, kurzus.nev,kurzus.max_letszam, f2.kod, f2.keresztnev, f2.vezeteknev";


        $stid = oci_parse($this->conn,$sql);
        oci_bind_by_name($stid, ":userId", $userId);
        oci_execute($stid);
        return $stid;
    }

    public function getUserById($userId)
    {
        
        $sql = "SELECT kod, jelszo, keresztnev, vezeteknev, admin, szemeszter, hallgato.felhasznalo_kod as hallgato_kod, TO_CHAR(tanitas_kezdete, 'YYYY-MM-DD HH24:MI') as tanitas_kezdete, oktato.felhasznalo_kod as oktato_kod
        FROM felhasznalo
        left join hallgato on  hallgato.felhasznalo_kod = felhasznalo.kod
        left join oktato on oktato.felhasznalo_kod = felhasznalo.kod
        where felhasznalo.kod = :userId";

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

