<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

include_once("../php/header.php");
require_once("../php/utils.php");

$utils = new Utils();
if(isset($_GET["terem_id"]) && is_numeric($_GET["terem_id"]) && isset($_GET["epulet_id"]) && is_numeric($_GET["epulet_id"])){
    $stid = $utils->getRoomsAndBuildingsById((int) $_GET["terem_id"],(int)$_GET["epulet_id"]);
    if($row = oci_fetch_assoc($stid)){
        $location = $row;
    }

}



$submitText = isset($location)? "Módosítások mentése" : "Új kurzus felvitele";
$teremNeve = isset($location)? $location["terem_nev"] : '';
$teremKodja = isset($location)? $location["terem_kod"] : '';

$epuletNeve = isset($location)? $location["epulet_nev"] : '';
$epuletKodja = isset($location)? $location["epulet_kod"] : '';
$action = isset($location)? "./updateRoom.php" : "./createRoom.php";



?>
<div class="container" >

    <form method="post" action="<?= $action ?>" >
        <div class="row" style="margin: 35px 0;">
            <div class="col-xs-6">
                <h2>Felhasználó</h2>
            </div>
            <div class="col-xs-6 ml-auto">
                <button type="submit" class="btn btn-success" name="saveLocation"><?= $submitText ?></button>
            </div>
        </div>

        <div class="form-group row">
            <label for="teremNev" class="col-sm-2 col-form-label">Terem neve</label>
            <div class="col-sm-10">
                <input required name="teremNev" type="text" class="form-control" id="teremNev" value="<?= $teremNeve ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="teremKod" class="col-sm-2 col-form-label">Terem kódja</label>
            <div class="col-sm-10">
                <input required name="teremKod" id="teremKod" type="number" class="form-control" value="<?= $teremKodja ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="epuletNev" class="col-sm-2 col-form-label">Épület neve</label>
            <div class="col-sm-10">
                <input required name="epuletNev" id="epuletNev" type="text" class="form-control" value="<?= $epuletNeve ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="epuletKod" class="col-sm-2 col-form-label">Épület kódja</label>
            <div class="col-sm-10">
                <input required name="epuletKod" id="epuletKod" type="number" class="form-control" value="<?= $epuletKodja ?>">
            </div>
        </div>


    </form>
</div>
<?php
include_once "../php/footer.php";
?>
