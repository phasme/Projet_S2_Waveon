<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'cnx.php';

if (isset($_GET['id']) AND $_GET['id']>0){
    $getid = intval($_GET['id']);
    $requsr = $bdd->prepare('SELECT * FROM user_person WHERE USER_ID = ?');
    $requsr->execute(array($getid));
    $userinfo = $requsr->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/styles_graphique.css">
        <link rel="stylesheet" href="../css/styles_mise_en_page.css">
        <link rel="stylesheet" href="../css/typographie.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="icon" href="../img/logo.svg" />
        <title>Mon profil</title>
    </head>
<body class="profil">
<div class="flex">
    <img src="../img/img_profil.svg" alt="Photo de profil">
    <div>
        <h4><?php echo $userinfo['USERNAME'] ?></h4>
        <h4><?php echo $userinfo['FIRSTNAME'] ?> <?php echo $userinfo['LASTNAME'] ?></h4>
        <?php
        if (isset($_SESSION['USER_ID']) AND $userinfo['USER_ID'] == $_SESSION['USER_ID']){
            ?>
            <a href="edit.php" class="flex icone_ajout_bio"><img src="../img/icone_ajout_bio.svg" alt="">
                Modifier mon profil</a>
            <?php
        }
        ?>
    </div>
</div>
<ul class="grille">
    <li class="profil_chiffres">
        <a href=""><span>0</span></a>
        Timeline
    </li>
    <span class="vertical-line"></span>
    <li class="profil_chiffres">
        <a href=""><span>0</span></a>
        Abonné
    </li>
    <span class="vertical-line"></span>
    <li class="profil_chiffres">
        <a href=""><span>0</span></a>
        Abonnement
    </li>
</ul>
</br>
<h5>Ma timeline</h5>
<!-- PLACER TIMELINE ICI -->
<button class="btn_subscription"><strong><a href="../subscription.html">+ Ajouter des timelines</a></strong></button>
<div class="deco_profil">
    <a href="deconnexion.php">Se déconnecter</a>
</div>
<!--<div>
    <h2>Profil de <?php /*echo $userinfo['USERNAME'] */?> </h2>
    <p>NOM : <?php /*echo $userinfo['LASTNAME'] */?> </p>
    <p>Prénom : <?php /*echo $userinfo['FIRSTNAME'] */?> </p>
    <p>Pseudo : <?php /*echo $userinfo['USERNAME'] */?> </p>
    <?php
/*    if (isset($_SESSION['USER_ID']) AND $userinfo['USER_ID'] == $_SESSION['USER_ID']){
    */?>
        <a href="edit.php">Editer mon profil</a>
        <a href="deconnexion.php">Se déconnecter</a>
    <?php
/*    }
    */?>
</div>-->
<footer>
    <img class="logo_footer" src="../img/footer_logo.svg" alt="Logo Waveon">
    <div class="liens_pages">
        <ul> <!-- LIENS PHP -->
            <li><a href="inscription.php">Inscription</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="../team.html">Notre équipe</a></li>
            <li><a href="#">Fonctionnement de Waveon</a></li>
        </ul>
    </div>
    <ul>
        <li>Nos réseaux sociaux</li>
    </ul>
    <ul class="flex">
        <li><a href="http://mmimontbeliard.com/"><img src="../img/logo_mmi.svg" alt="Logo DUT MMI Montbéliard"></a></li>
        <li><a href="https://www.instagram.com/waveon_jsj/"><img src="../img/logo_instagram.svg" alt="Logo Instagram"></a></li>
        <li><a href="https://www.facebook.com/"><img src="../img/logo_facebook.svg" alt="Logo Facebook"></a></li>
        <li><a href="https://www.youtube.com/"><img src="../img/logo_youtube.svg" alt="Logo Youtube"></a></li>
    </ul>

    <div class="liens_pages2">
        <ul>
            <li><a href="../legal_notices.html">Mentions légales</a></li>
        </ul>
    </div>
</footer>
</body>
</html>
<?php
}
else{
    header('Location: connexion.php');
}
?>
<!-- pour afficher l'image <img src="php/images/<?php /*$_SESSION['PROFIL_PICTURE'] */?>" alt="">-->