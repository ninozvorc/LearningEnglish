<?php
include_once ("okviri/user.class.php");
include_once ("okviri/baza.class.php");

session_start();
if (!isset($_SESSION["prijava"])) {
    header("Location: prijava.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Učenje Engleskog</title>
        <link rel="stylesheet" href="stylesheets/foundation.min.css" />
        <link rel="stylesheet" href="stylesheets/css_nzvorc.css" />
    </head>
    <body>

        <?php include_once ("okviri/meni.php"); ?>

        <div class="row">
            <br>
            <div class="large-12 columns">
                <h1 style=" text-align: center;">Učenje Engleski > Hrvatski</h1><br>
            </div>
        </div>
        <br>
        <br>
        <?php include_once ("okviri/footer.php"); ?>

    </body>
</html>
