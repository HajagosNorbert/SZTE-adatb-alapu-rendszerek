<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

include_once("../php/header.php");
require_once("../php/utils.php");

$utils = new Utils();
if(isset($_GET["epulet_id"]) && is_numeric($_GET["epulet_id"])){
    $stid = $utils->getBuildingById((int) $_GET["epulet_id"]);
    if($row = oci_fetch_assoc($stid)){
        $building = $row;
    }

}


$submitText = isset($building)? "Módosítások mentése" : "Új épület felvitele";
$epuletNeve = isset($building)? $building["NEV"] : '';
$action = isset($building)? "./updateBuilding.php" : "./createBuilding.php";



?>
<div class="container" >

    <form method="post" action="<?= $action ?>" >
        <div class="row" style="margin: 35px 0;">
            <div class="col-xs-6">
                <h2>Épület</h2>
            </div>
            <div class="col-xs-6 ml-auto">
                <button type="submit" class="btn btn-success" name="saveBuilding"><?= $submitText ?></button>
            </div>
        </div>

        <div class="form-group row">
            <label for="epuletNev" class="col-sm-2 col-form-label">Épület neve</label>
            <div class="col-sm-10">
                <input required name="epuletNev" id="epuletNev" type="text" class="form-control" value="<?= $epuletNeve ?>">
            </div>
        </div>
    </form>
</div>
<?php
include_once "../php/footer.php";
?>
