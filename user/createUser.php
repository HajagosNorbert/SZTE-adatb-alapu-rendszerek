<?php

require_once("../php/utils.php");
session_start();


if(!isset($_POST["saveUser"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

$admin = isset($_POST["admin"])? "1": "0";

if (isset($_POST["tanitas_kezdete"])){
  $tanitas_kezdete = date('d-m-Y h:i:s', strtotime($_POST['tanitas_kezdete']));  
} else {
  $tanitas_kezdete = date('d-m-Y h:i:s');
}

$szemeszter = isset($_POST["szemeszter"])? $_POST["szemeszter"]: 1;

$utils = new Utils();
$userId = $utils->createUser($_POST["vezeteknev"], $_POST["keresztnev"], $_POST["jelszo"], $admin, $_POST["userType"], $szemeszter, $tanitas_kezdete);


header("location: ./userForm.php?id=$userId");





