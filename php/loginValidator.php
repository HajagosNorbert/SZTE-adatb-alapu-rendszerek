<?php 
session_start();
require_once("utils.php");

if(!isset($_POST["login"])){
    header("location: index.php");
}

$userId = (int)trim($_POST["userId"]);
$password = trim($_POST["password"]);

$error = [];

if(empty($userId) || empty($password)){
    $error[] = "Tölts ki minden mezőt!";
    header("location: ../index.php");
}


$util = new Utils();
$stid = $util->getUserById($userId);

$row = oci_fetch_assoc($stid);

if(count($error) == 0){
    if($password !== $row["JELSZO"]){
        header("location: ../index.php");
    }

    $_SESSION["userId"] = $row["KOD"];
    if($row["ADMIN"] == 1 ){
        $_SESSION["admin"] = 1;
    }
    if(!is_null($row["HALLGATO_KOD"])){
        $_SESSION["student"] = 1;
    }
    if(!is_null($row["OKTATO_KOD"])){
        $_SESSION["teacher"] = 1;
    }

    header("location: /course/");
  
}







