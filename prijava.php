<?php
include_once ("okviri/user.class.php");
include_once ("okviri/baza.class.php");
$baza = new Baza();

session_start();
if (isset($_SESSION["prijava"])) {
    header("Location: index.php");
    exit();
}

$error = "";

if (isset($_POST["username"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $upit = "select * from user where '$username'=username;";
    $podaci = $baza->selectDB($upit);
    if ($red = $podaci->fetch_array()) {
        $id = $red['id'];
        $name = $red['name'];
        $username = $red['username'];
        $pass = $red['password'];

        if ($pass != $password) {
            $error = "Pogrešno korisničko ime ili lozinka!";
        } else {
            $user = new User();
            $user->set($id, $name, $username, $pass, $email);
            session_start();
            $_SESSION["prijava"] = $user;
            header("Location: index.php");
            exit();
        }
    } else {
        $error = "Pogrešno korisničko ime ili lozinka!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Vučenje Engleskog Prijava</title>
        <link rel="stylesheet" href="stylesheets/foundation.min.css" />
        <link rel="stylesheet" href="stylesheets/css_nzvorc.css" />
        <link rel="shortcut icon" href="http://46.101.196.18/images/logo.ico"/>
    </head>
    <body>

        <?php include_once ("okviri/meni.php"); ?>
        <br>

        <div class="row">
            <div class="large-12 columns">
                <h2 style=" text-align: center;"> Prijava </h2><br>

                <form name="prijava" action="#" method="POST"  >

                    <div class="row">
                        <div class="large-12 columns">
                            <label>Korisničko ime
                                <input type="text" required="" name="username" autofocus="" value="nzvorc"/>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="large-12 columns">
                            <label>Lozinka
                                <input type="password" required="" name="password" value="nzvorc"/>
                            </label>
                        </div>
                    </div>
                    <h6 style="color: red"><?php echo $error; ?></h6><br>
                    <div class="row">
                        <div class="large-6 large-offset-3 columns">
                            <input type="submit" value="Prijavi se" class="button expand tiny"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php include_once ("okviri/footer.php"); ?>

    </body>
</html>
