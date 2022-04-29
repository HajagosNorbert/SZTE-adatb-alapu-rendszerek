<?php
session_start();


if(!isset($_SESSION["userId"]) || !isset($_SESSION["admin"])){
  header("location: /");
}

include_once("../php/header.php");  
require_once("../php/utils.php");  

$utils = new Utils();
if(isset($_GET["id"]) && is_numeric($_GET["id"])){
  $stid = $utils->getUserById((int) $_GET["id"]);
  if($row = oci_fetch_assoc($stid)){
    $user = $row;
  }
}

$submitText = isset($user)? "Módosítások mentése" : "Új felhasználó létrehozása";
$vezeteknev = isset($user)? $user["VEZETEKNEV"] : '';
$keresztnev = isset($user)? $user["KERESZTNEV"] : '';
$jelszo = isset($user)? $user["JELSZO"] : '';
$checkedIfAdmin = (isset($user) && $user["ADMIN"])? 'checked' : '';
$disabledIfSelf = (isset($user) && $_SESSION["userId"] === $user["KOD"])? 'disabled' : '';
$userType = (isset($user))? $utils->determinUserType($user): 'inaktiv';

$szemeszter = (isset($user) && isset($user["SZEMESZTER"]))? $user["SZEMESZTER"] : null;
$tanitas_kezdete = (isset($user) && isset($user["TANITAS_KEZDETE"]))? $user["TANITAS_KEZDETE"] : null;
$tanitas_kezdete = str_replace(" ", "T", $tanitas_kezdete);
$action = isset($user)? "./updateUser.php" : "./createUser.php";
?>
<div class="container" >

  <form method="post" action="<?= $action ?>" >
  <?php 
  if (isset($user)){
    echo '<input type="hidden" name="userId" value="'.$user["KOD"].'">';
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
      <label for="vezeteknev" class="col-sm-2 col-form-label">Vezetéknév</label>
      <div class="col-sm-10">
        <input required name="vezeteknev" type="text" class="form-control" id="vezeteknev" value="<?= $vezeteknev ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="keresztnev" class="col-sm-2 col-form-label">Keresztnév</label>
      <div class="col-sm-10">
        <input required name="keresztnev" id="keresztnev" type="text" class="form-control" value="<?= $keresztnev ?>">
      </div>
    </div>
    <div class="form-group row">
      <label for="jelszo" class="col-sm-2 col-form-label">Jelszó</label>
      <div class="col-sm-10">
        <input required name="jelszo" type="password" class="form-control" id="jelszo" value="<?= $jelszo ?>">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-2">Admin</div>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="admin" id="gridCheck1" <?= "$checkedIfAdmin $disabledIfSelf" ?>>
          <label class="form-check-label" for="gridCheck1">
            Admin
          </label>
        </div>
      </div>
    </div>

    <fieldset class="form-group">
      <div class="row">
        <legend class="col-form-label col-sm-2 pt-0">Felhasználó típus</legend>
        <div class="col-sm-10">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="userType" id="hallgato" value="hallgato" <?= ($userType === "hallgato" )? "checked": "" ?>>
            <label class="form-check-label" for="hallgato">
              Hallgató
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="userType" id="oktato" value="oktato" <?= ($userType === "oktato" )? "checked": "" ?>>
            <label class="form-check-label" for="oktato">
              Oktató
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="userType" id="phd" value="phd" <?= ($userType === "phd" )? "checked": "" ?>>
            <label class="form-check-label" for="phd">
              PHD
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="userType" id="inaktiv" <?= ($userType === "inaktiv" )? "checked": "" ?> value="inaktiv">
            <label class="form-check-label" for="inaktiv">
              Inaktív
            </label>
          </div>
        </div>
      </div>
    </fieldset>

    <?php if($userType === "phd" || $userType === "hallgato" ): ?>
    <div class="form-group row">
      <label for="szemeszter" class="col-sm-2 col-form-label">Szemeszter</label>
      <div class="col-sm-10">
        <input required name="szemeszter" type="integer" class="form-control" id="szemeszter" value="<?= $szemeszter ?>">
      </div>
    </div>
    <?php endif; ?>

    <?php if($userType === "phd" || $userType === "oktato" ): ?>
    <div class="form-group row">
      <label for="tanitas_kezdete" class="col-sm-2 col-form-label">Tanítást kezdte</label>
      <div class="col-sm-10">
        <input required name="tanitas_kezdete" type="datetime-local" class="form-control" id="tanitas_kezdete" value="<?= $tanitas_kezdete ?>">
      </div>
    </div>
    <?php endif; ?>
  </form>
</div>
<?php
include_once "../php/footer.php";
?>
