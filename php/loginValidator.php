<?php
require_once("utils.php");

if(!isset($_POST["login"])){
    header("location: index.php");
}

$db = new Database();

$userId = (int)trim($_POST["userId"]);
$password = trim($_POST["password"]);

$error = [];

if(empty($userId) || empty($password)){
    $error[] = "Tölts ki minden mezőt!";
    header("location: ../index.php");
}


$util = new functions();
$stid = $util->getUserById($userId);

$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
print_r($row);

if(count($error) == 0){
    if($password == $row["JELSZO"]){

        $_SESSION["userID"] = $row["KOD"];
        if($row["ADMIN"] == 1 ){
            $_SESSION["admin"] = 1;
        }

        header("location: ../course/index.php");
    }else{
        header("location: ../index.php");
    }
}







