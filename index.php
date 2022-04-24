
<?php
session_start();

include_once "./php/header.php";

if(isset($_SESSION["userId"])){
    header("location: course/");
}

?>

<form action="./php/loginValidator.php" method="post">
    <div class="form-group" style="width: 20%;margin-left: 37%">
        <label for="userId">Azonosító:</label>
        <input type="text" name="userId" id="userId" class="form-control" placeholder="Azonosító">

        <br>

        <label for="password">Jelszó:</label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Jelszó">
        <br>

        <button type="submit" name="login" id="loginButton" style="margin-left: 37%" class="btn btn-primary">Bejelentkezés</button>
    </div>
</form>
<?php
include_once "php/footer.php";
?>