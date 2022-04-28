<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Felvett kurzusok</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

<?php 
if(isset($_SESSION["userId"]) || isset($_SESSION["admin"])):
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="/">Főoldal</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/course/">Kurzusok</a>
            </li>
            <?php if (isset($_SESSION["admin"])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/user/">Felhasználók</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/room/rooms.php">Termek és épületek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/log/">Log</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/course/exam/">Vizsgák</a>
                </li>
            <?php endif ?>
        </ul>

    <?php 
        if (isset($_SESSION["admin"]) || isset($_SESSION["userId"])):
    ?>
        <a href='/php/logout.php' style='color: black' class='text-decoration-none'><button type='submit' class='btn btn-info'>Kijelentkezés</button></a>
    <?php 
    endif;
    ?>
    </div>
</nav>
<?php 
endif;
?>