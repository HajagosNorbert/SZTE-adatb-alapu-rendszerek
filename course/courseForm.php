<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
    header("location: /");
}

include_once("../php/header.php");
require_once("../php/utils.php");

$utils = new Utils();
if(isset($_GET["id"]) && is_numeric($_GET["id"])){
    $stid = $utils->getCourseById((int) $_GET["id"]);
    if($row = oci_fetch_assoc($stid)){
        $course = $row;
    }

}



$submitText = isset($course)? "Módosítások mentése" : "Új kurzus felvitele";
$kurzusNev = isset($course)? $course["NEV"] : '';
$maxLetszam = isset($course)? $course["MAX_LETSZAM"] : '';

$teremKod = isset($course)? $course["TEREM_KOD"] : '';
$epuletKOD = isset($course)? $course["EPULET_KOD"] : '';
$action = isset($course)? "./updateCourse.php" : "./createCourse.php";

$locationSelect = $utils -> getRoomsAndBuildings();
if($rowLocations = oci_fetch_assoc($locationSelect)){
    $location = $rowLocations;
}

?>
<div class="container" >

    <form method="post" action="<?= $action ?>" >
        <?php
        if (isset($course)){
            echo '<input type="hidden" name="courseId" value="'.$course["KOD"].'">';
        }
        ?>
        <div class="row" style="margin: 35px 0;">
            <div class="col-xs-6">
                <h2>Felhasználó</h2>
            </div>
            <div class="col-xs-6 ml-auto">
                <button type="submit" class="btn btn-success" name="saveUser"><?= $submitText ?></button>
            </div>
        </div>

        <div class="form-group row">
            <label for="kurzusNev" class="col-sm-2 col-form-label">Kurzus neve</label>
            <div class="col-sm-10">
                <input required name="kurzusNev" type="text" class="form-control" id="kurzusNev" value="<?= $kurzusNev ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="letszam" class="col-sm-2 col-form-label">Max létszám</label>
            <div class="col-sm-10">
                <input required name="letszam" id="letszam" type="text" class="form-control" value="<?= $maxLetszam ?>">
            </div>
        </div>

        <label for="helyszin">Helyszín:</label>
        <select name="helyszin" id="helyszin">
            <option value=''>--- Choose a color ---</option>
            <?php
            while ($rowLocations = oci_fetch_assoc($locationSelect)) :

                $terem_kod = $rowLocations['terem_kod'] !== null ? htmlentities($rowLocations['terem_kod'], ENT_QUOTES) : '0';
                $terem_nev = $rowLocations['terem_nev'] !== null ? htmlentities($rowLocations['terem_nev'], ENT_QUOTES) : 'nincs terme';
                $epulet_nev = $rowLocations['epulet_nev'] !== null ? htmlentities($rowLocations['epulet_nev'], ENT_QUOTES) : 'hiba az épülette';
                $epulet_kod = $rowLocations['epulet_kod'] !== null ? htmlentities($rowLocations['epulet_kod'], ENT_QUOTES) : '-1';

                echo "<option value='$terem_kod:$epulet_kod'>$terem_kod,$terem_nev , $epulet_nev</option>";


            endwhile;
            ?>
        </select>

    </form>
</div>
<?php
include_once "../php/footer.php";
?>
