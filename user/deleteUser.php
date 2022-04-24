<?php
require_once("../php/utils.php");
session_start();

if(!isset($_SESSION["userId"])){
    header("location: /");
}

if($_POST["userId"] == $_SESSION["userId"]){
    header("location: /user/");
}
echo $_POST['userId']. "számú felhasználó törlése (majd) ";
//$utils = new Utils();
//$stid = $utils->deleteUser($_POST["userId"]);
