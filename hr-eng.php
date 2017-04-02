<?php
include_once ("okviri/user.class.php");
include_once ("okviri/baza.class.php");
$baza = new Baza();

session_start();
if (!isset($_SESSION["prijava"])) {
    header("Location: prijava.php");
    exit();
}
$mess = "";
$displ = "";
$color = "";
$resp = "";
$disply = "";

if (isset($_POST["engl"])) {
    $displ = "style=\"display: none\"";
    $eng_word = $_POST["engl"];
    $hr_word = $_POST["croa"];

    $query = "select * from hr_word h, en_word e, dictionary d, word_type w where w.id=d.word_type and h.id=d.hr_word and e.id=d.en_word and h.word like '$hr_word' and e.word like '$eng_word' ";
    $data = $baza->selectDB($query);
    if ($data->fetch_array()) {
        $mess = "Odgovor je točan!";
        $color = "green";
    } else {
        $mess = "Odgovor je netočan!";
        $color = "red";
    }
    $query = "select * from hr_word h, en_word e, dictionary d, word_type w where w.id=d.word_type and h.id=d.hr_word and e.id=d.en_word and e.word like '$eng_word' ";
    $odgovori = $baza->selectDB($query);
} else {
    $disply = "style=\"display: none\"";

    $query = "select * from hr_word h, en_word e, dictionary d, word_type w where w.id=d.word_type and h.id=d.hr_word and e.id=d.en_word and d.hr_en_p=0;";
    $data = $baza->selectDB($query);

    while ($row = $data->fetch_array()) {
        $array[] = $row;
    }

    $random = $array[array_rand($array)];
    $hrWord = $random[1];
    $wordType = $random[13];
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
                <h1 style=" text-align: center;">Hrvatski &#8594; Engleski</h1><br>
            </div>
            <br><br><br><br>
            <form action="#" method="POST" <?php echo $displ ?> >
                <div class="row">
                    <div class="large-12 columns">
                        <h2 style=" text-align: center;"><?php echo $hrWord ?></h2>
                        <h4 style=" text-align: center;">(<?php echo $wordType ?>)</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="large-12 columns">
                        <input type="text" autocomplete="off" required="" name="engl" style="margin-top: 20px;margin-bottom: 30px" />
                    </div>                    
                    <div class="large-12 columns" style="display: none">
                        <input type="text" autocomplete="off" required="" name="croa" value="<?php echo $hrWord ?>" />
                    </div>
                </div>                
                <div class="row">
                    <div class="large-6 large-offset-3 columns">
                        <input type="submit" value="Potvrdi" class="button expand tiny"/>
                    </div>
                </div>
            </form>
            <div class="row" <?php echo $disply ?> >
                <h2 style="color: <?php echo $color; ?>; text-align: center;"><?php echo $mess; ?></h2><br>
               <?php
                while ($row = $odgovori->fetch_array()) {
                    echo "<h3 style=\"text-align: center;\">$row[3] &#8594; $row[1]</h3><br>";
                }
                ?>                
                <div class="large-2 large-offset-5 columns">
                    <a class="button expand tiny" href="hr-eng.php"  >Nastavi</a>
                </div>
            </div>


        </div>
        <br>
        <br>
        <?php include_once ("okviri/footer.php"); ?>

    </body>
</html>
