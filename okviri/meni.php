<?php
include_once ("user.class.php");
$user = new User();

$id = 0;

if (isset($_SESSION["prijava"])) {
    $user = $_SESSION["prijava"];
    $id = $user->getId();
    $name = $user->getName();
}
?>

<div class="fixed">
    <nav class="top-bar" data-topbar>
        <ul class="title-area">   
            <li class="name">				
                <h1><a href="index.php">Vučenje Engleskog</a></h1>
            </li>
        </ul>
        <section class="top-bar-section">
            <ul class="left">
                <li class="divider"></li>
                <li class="divider"></li>
                <li class="divider"></li>
                <?php if ($id != 1) { ?>
                    <li><a href="prijava.php">Prijava</a></li>
                    <li class="divider"></li>
                <?php } else { ?>
                    <li><a href="index.php">Unašanje riječi</a></li>
                    <li class="divider"></li>
                    <li><a href="eng-hr.php">Učenje Eng - Cro</a></li>
                    <li class="divider"></li>
                    <li><a href="hr-eng.php">Učenje Cro - Eng</a></li>
                    <li class="divider"></li>                 
                    <li><a href="rijecnik.php">Riječnik</a></li>
                    <li class="divider"></li>                   
                    <li><a href="rijecnik_sve.php">Riječnik-Sve</a></li>
                    <li class="divider"></li>
                </ul>
                <ul class="right">
                    <li class="divider"></li>
                    <li class="name">
                        <h1><a href="#"> <?php echo $name; ?> </a></h1>
                    </li>
                    <li class="divider"></li>
                    <li><a href="odjava.php">Odjava</a></li>
                </ul>
            <?php } ?>
        </section>
    </nav>
</div>
