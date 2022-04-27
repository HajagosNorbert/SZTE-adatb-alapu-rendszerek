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

    
    public function getExamById($id)
    {
        $sql = "select * from vizsga where kod = :id";

        $stid = oci_parse($this->conn,$sql);
        oci_bind_by_name($stid, ":id", $id);
        oci_execute($stid);
        return $stid;
    }
    public function getAnnouncmentsByCourseId($courseId)
    {
        $sql = "SELECT kod,felhasznalo_kod,tartalom FROM hirdetmeny WHERE kurzus_kod = :courseId";


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

    public function getCourses(){
        $sql = "SELECT kod, nev from kurzus";
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);
        return $stid;
    }

    public function getCoursesWithStudentCount(){
        $sql = "select kurzus.kod, kurzus.nev, kurzus.max_letszam, count(kurzus.nev) AS letszam, f2.kod as oktato_kod, f2.keresztnev as oktato_keresztnev, f2.vezeteknev as oktato_vezeteknev
        from kurzus 
        inner join feliratkozas on kurzus.kod = feliratkozas.kurzus_kod 
        inner join felhasznalo on feliratkozas.hallgato_kod = felhasznalo.kod
        inner join felhasznalo f2 on kurzus.oktato_kod = f2.kod
        group by kurzus.kod, kurzus.nev,kurzus.max_letszam, f2.kod, f2.keresztnev, f2.vezeteknev";
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);
        return $stid;
    }



    public function deleteCourseById($courseId){

        $sql = "DELETE FROM kurzus where kod = :courseId";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":courseId", $courseId);
        oci_execute($stid);
    }

    public function getRoomsAndBuildings(){

        $sql = 'SELECT terem.kod AS "terem_kod", terem.nev AS "terem_nev", epulet.kod AS "epulet_kod", epulet.nev AS "epulet_nev" FROM terem right join epulet on terem.epulet_kod = epulet.kod';
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);
        return $stid;
    }

    public function deleteRoomById($roomId,$buildingId){
        $delete_course = "DELETE FROM kurzus WHERE terem_kod = :roomId AND epulet_kod = :buildingId";
        $stid_course = oci_parse($this->conn, $delete_course);
        oci_bind_by_name($stid_course, ":roomId", $roomId);
        oci_bind_by_name($stid_course, ":buildingId", $buildingId);
        oci_execute($stid_course);

        $delete_exam = "DELETE FROM vizsga WHERE terem_kod = :roomId AND epulet_kod = :buildingId";
        $stid_exam = oci_parse($this->conn, $delete_exam);
        oci_bind_by_name($stid_exam, ":roomId", $roomId);
        oci_bind_by_name($stid_exam, ":buildingId", $buildingId);
        oci_execute($stid_exam);


        $delete_rooms = "DELETE FROM terem where terem.kod = :roomId AND epulet_kod = :buildingId";
        $stid = oci_parse($this->conn, $delete_rooms);
        oci_bind_by_name($stid, ":roomId", $roomId);
        oci_bind_by_name($stid, ":buildingId", $buildingId);
        oci_execute($stid);
    }

    public function getExams(){
        $sql = "select vizsga.kod, vizsga.idopont, vizsga.kurzus_kod, vizsga.terem_kod, vizsga.epulet_kod, kurzus.nev as kurzus_nev, epulet.nev as epulet_nev 
        from vizsga
        inner join kurzus on kurzus.kod = vizsga.kurzus_kod
        inner join epulet on epulet.kod = vizsga.epulet_kod";
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);
        return $stid;
    }

    public function getLogs(){
        $sql = "select log.kod, felhasznalo.vezeteknev, felhasznalo.keresztnev, log.bejelentkezesi_ido from log inner join felhasznalo on log.felhasznalo_kod = felhasznalo.kod";
        $stid = oci_parse($this->conn, $sql);
        oci_execute($stid);
        return $stid;
    }

    public function deleteLog($logId){
        $sql = "DELETE FROM log where kod = :logId";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":logId", $logId);
        oci_execute($stid);
    }

    public function deleteExamById($id){
        $sql = "DELETE FROM vizsga where kod = :id";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":id", $id);
        oci_execute($stid);
    }


    public function deleteUser($userId)
    {
        $sql = "delete FROM felhasznalo where felhasznalo.kod = :userId";

        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":userId", $userId);
        oci_execute($stid);
        return $stid;
    }

    public function deleteSubscription($courseId, $studentId)
    {
        $sql = "delete FROM feliratkozas where hallgato_kod = :studentId and kurzus_kod = :courseId ";

        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":studentId", $studentId);
        oci_bind_by_name($stid, ":courseId", $courseId);
        oci_execute($stid);
        return $stid;
    }
    
    public function countBuildingById($buildingId){
        $sql_count = 'select count(epulet.nev) as "darab"'. "from terem inner join epulet on terem.epulet_kod = epulet.kod where epulet_kod = :buildingId ";
        oci_bind_by_name($stid, ":buildingId", $buildingId);
        $stid = oci_parse($this->conn, $sql_count);
        oci_execute($stid);

        return $stid;
    }

    public function deleteBuildingById($buildingId){
        $sql = "delete from epulet where kod = :buildingId";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":buildingId", $buildingId);
        oci_execute($stid);
        return $stid;
    }

    public function deleteAnnouncmentById($id){
        $sql = "delete from hirdetmeny where kod = :announcmentId";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":announcmentId", $id);
        oci_execute($stid);
        return $stid;
    }

    public function getBejegyzesekFromId($courseId){
        $sql = "SELECT kod,felhasznalo_kod,tartalom FROM bejegyzes WHERE kurzus_kod = :courseId";

        $stid = oci_parse($this->conn,$sql);
        oci_bind_by_name($stid, ":courseId", $courseId);
        oci_execute($stid);
        return $stid;
    }

    public function deleteBejegyzesById($id){
        $sql = "delete from bejegyzes where kod = :bejegyzesId";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":bejegyzesId", $id);
        oci_execute($stid);
        return $stid;
    }
    
    public function getDoksik(){
        $sql = "SELECT kod,nev FROM tananyag";
        
        $stid = oci_parse($this->conn,$sql);
        oci_execute($stid);
        return $stid;
    }
    
    public function getBejegyzesById($id){
        $sql = "SELECT * FROM bejegyzes where kod = :id";
        
        $stid = oci_parse($this->conn,$sql);
        oci_bind_by_name($stid, ":id", $id);
        oci_execute($stid);
        return $stid;
    }

    public function deleteDoksiById($doksiId){
        $sql = "delete from tananyag where kod = :doksiId";
        $stid = oci_parse($this->conn, $sql);
        oci_bind_by_name($stid, ":doksiId", $doksiId);
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

