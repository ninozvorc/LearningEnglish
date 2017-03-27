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

$upit = "select * from hr_word h, en_word e, dictionary d, word_type w where w.id=d.word_type and h.id=d.hr_word and e.id=d.en_word;";
$podaci = $baza->selectDB($upit);
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Vučenje Engleskog</title>
        <link rel="stylesheet" href="stylesheets/foundation.css" />
        <link rel="stylesheet" href="stylesheets/css_nzvorc.css" />
        <link rel="shortcut icon" href="http://46.101.196.18/images/logo.ico"/>
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
    </head>
    <body>

        <?php include_once ("okviri/meni.php"); ?>
        <br>
        <div class="row">
            <h3 style=" text-align: center;">Riječnik</h3><br>

            <table id="tablica" class="display" >
                <thead>
                    <tr>
                        <th>Br</th>
                        <th>Engleski</th>
                        <th>Hrvatski</th>
                        <th>Vrsta riječi</th>
                        <th style="width: 80px; text-align: center;">HR-EN +</th>
                        <th style="width: 80px; text-align: center;">HR-EN -</th>                        
                        <th style="width: 80px; text-align: center;">EN-HR +</th>
                        <th style="width: 80px; text-align: center;">EN-HR -</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $brojac = 1;
                    while ($row = $podaci->fetch_array()) {
                        echo '<tr>';
                        echo "<td>$brojac</td>";
                        echo "<td>$row[3]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[13]</td>";
                        echo "<td style=\"width: 60px; text-align: center; color: green\">$row[8]</td>";
                        echo "<td style=\"width: 60px; text-align: center; color: red\">$row[9]</td>";                        
                        echo "<td style=\"width: 60px; text-align: center; color: green\">$row[10]</td>";
                        echo "<td style=\"width: 60px; text-align: center; color: red\">$row[11]</td>";
                        echo '</tr>';
                        $brojac++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php include_once ("okviri/footer.php"); ?>

    </body>
</html>
