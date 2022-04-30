<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

include_once("../php/header.php");
require_once("../php/utils.php");

$utils = new Utils();
if(isset($_GET["terem_id"]) && is_numeric($_GET["terem_id"]) && isset($_GET["epulet_id"]) && is_numeric($_GET["epulet_id"])){
    $stid = $utils->getRoomById((int) $_GET["terem_id"]);
    if($row = oci_fetch_assoc($stid)){
        $room = $row;
    }

}



$submitText = isset($room)? "Módosítások mentése" : "Új terem felvitele";
$teremNeve = isset($room)? $room["NEV"] : '';
$teremKodja = isset($room)? $room["KOD"] : '';
$epuletKodja = isset($room) ? $_GET["epulet_id"] : '';


$action = isset($room)? "./updateRoom.php?terem_id=$teremKodja&epulet_id=$epuletKodja" : "./createRoom.php";



?>
<div class="container" >

    <form method="post" action="<?= $action ?>" >
        <div class="row" style="margin: 35px 0;">
            <div class="col-xs-6">
                <h2>Terem</h2>
            </div>
            <div class="col-xs-6 ml-auto">
                <button type="submit" class="btn btn-success" name="saveRoom"><?= $submitText ?></button>
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



    </form>
</div>
<?php
include_once "../php/footer.php";
?>
