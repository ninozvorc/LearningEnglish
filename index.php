<?php
include_once ("okviri/user.class.php");
include_once ("okviri/baza.class.php");
$baza = new Baza();

$error = "";
$mess = "";

session_start();
if (!isset($_SESSION["prijava"])) {
    header("Location: prijava.php");
    exit();
}

$wordTypesUpit = "select * from word_type;";
$wordTypes = $baza->selectDB($wordTypesUpit);

if (isset($_POST["cro"]) && isset($_POST["eng"])) {
    $cro_word = $_POST["cro"];
    $eng_word = $_POST["eng"];
    $word_type = $_POST["vrsta"];

    $hrUpit = "select * from hr_word where '$cro_word'=word;";
    $hrPodaci = $baza->selectDB($hrUpit);
    if ($red = $hrPodaci->fetch_array()) {
        $idCro = $red['id'];
    } else {
        $upit = "INSERT INTO hr_word values('dafault','$cro_word');";
        $baza->updateDB($upit);

        $hrUpit = "select * from hr_word where '$cro_word'=word;";
        $hrPodaci = $baza->selectDB($hrUpit);
        $red = $hrPodaci->fetch_array();
        $idCro = $red['id'];
    }

    $enUpit = "select * from en_word where '$eng_word'=word;";
    $enPodaci = $baza->selectDB($enUpit);
    if ($red = $enPodaci->fetch_array()) {
        $idEng = $red['id'];
    } else {
        $upit = "INSERT INTO en_word values('dafault','$eng_word');";
        $baza->updateDB($upit);

        $enUpit = "select * from en_word where '$eng_word'=word;";
        $enPodaci = $baza->selectDB($enUpit);
        $red = $enPodaci->fetch_array();
        $idEng = $red['id'];
    }

    $upit = "select * from dictionary where '$idCro'=hr_word and '$idEng'=en_word;";
    $podaci = $baza->selectDB($upit);
    if ($red = $podaci->fetch_array()) {
        $error = "Zapis vec postoji u bazi!";
    } else {
        $upit = "INSERT INTO dictionary values($idCro,$idEng,'',$word_type,0,0,0,0)";
        $baza->updateDB($upit);
        $mess = "Zapis uspješno dodan!";
    }
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Vučenje Engleskog</title>
        <link rel="stylesheet" href="stylesheets/foundation.min.css" />
        <link rel="stylesheet" href="stylesheets/css_nzvorc.css" />
        <link rel="shortcut icon" href="http://46.101.196.18/images/logo.ico"/>
    </head>
    <body>

<?php include_once ("okviri/meni.php"); ?>
        <br>
        <div class="row">
            <div class="large-12 columns">
                <h2 style=" text-align: center;">Nova riječ</h2><br>
            </div>
            <form action="#" method="POST"  >
                <div class="row">
                    <div class="large-12 columns">
                        <label>Engleska riječ
                            <input type="text" required="" name="eng"  autofocus=""/>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label>Hrvatska riječ
                            <input type="text" required="" name="cro" />
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <label>Vrsta riječi
                            <select required="" name="vrsta" >
                                <?php
                                while ($red = $wordTypes->fetch_array()) {
                                    echo "<option style=\"padding: 5px;\" value=$red[0]> $red[1]</option>";
                                }
                                ?>
                            </select>
                        </label>
                    </div>
                </div>
                <h6 style="color: red"><?php echo $error; ?></h6><br>
                <h6 style="color: green"><?php echo $mess; ?></h6><br>
                <div class="row">
                    <div class="large-6 large-offset-3 columns">
                        <input type="submit" value="Unesi riječ" class="button expand tiny"/>
                    </div>
                </div>
            </form>
        </div>
        <br>
<?php include_once ("okviri/footer.php"); ?>

    </body>
</html>
