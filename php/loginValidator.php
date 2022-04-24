<?php
session_start();
require_once("connection.php");

if(!isset($_POST["login"])){
    header("location: index.php");
}

$db = new Database();

$studentID = (int)trim($_POST["studentID"]);
$password = trim($_POST["password"]);

$error = [];

if(empty($studentID) || empty($password)){
    $error[] = "Tölts ki minden mezőt!";
    header("location: ../index.php");
}


$conn = $db -> connect();


$stid = oci_parse($conn, "SELECT * FROM felhasznalo where kod = $studentID");
oci_execute($stid);



$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
print_r($row);
if(count($error) == 0){
    if($password == $row["JELSZO"]){

        if($row["ADMIN"] == 1 ){
            $_SESSION["admin"] = $row["KOD"];
        }else{
            $_SESSION["userID"] = $row["KOD"];
        }

        header("location: ../course/index.php");
    }else{
        header("location: ../index.php");
    }
}











