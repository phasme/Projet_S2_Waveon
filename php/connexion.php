<?php
header("Access-Control-Allow-Origin: *");
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'cnx.php';

if(isset($_POST['connect_form'])){
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if(!empty($mailconnect) AND !empty($mdpconnect)){
        $requsr = $bdd->prepare("SELECT * FROM user_person WHERE MAIL= ? AND USER_PASSWORD = ?");
        $requsr->execute(array($mailconnect,$mdpconnect));
        $userexist = $requsr->rowCount();
        if ($userexist == 1){
            $userinfo = $requsr->fetch();
            $_SESSION['USER_ID'] = $userinfo['USER_ID'];
            $_SESSION['LASTNAME'] = $userinfo['LASTNAME'];
            $_SESSION['FIRSTNAME'] = $userinfo['FIRSTNAME'];
            $_SESSION['USERNAME'] = $userinfo['USERNAME'];
            header("Location: profil.php?id=".$_SESSION['USER_ID']);

        }else{
            $erreur="Mauvaise adresse mail ou mauvais mot de passe";
        }
    }else{
        $erreur="Tout les champs doivent être complétés";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion à Waveon</title>
    <link rel="stylesheet" href="../css/styles_graphique.css">
    <link rel="stylesheet" href="../css/styles_mise_en_page.css">
    <link rel="stylesheet" href="../css/typographie.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="connexion">
<header>
    <div class="navbar">
        <a href="../index.html"><img src="../img/logo.svg" alt="logo"></a>
    </div>
</header>
<div class="formulaire">
    <h2>Connexion</h2>
    <form method="POST" action="">

        <label for="mailconnect">Adresse mail</label>
        <input type="email" id="mail" placeholder="Saisissez votre adresse mail" name="mailconnect">

        <label for="mdpconnect">Saisissez votre mot de passe</label>
        <input type="password" id="mdpconnect" placeholder="Saisissez votre mot de passe" name="mdpconnect">

        <input class="btn_m" type="submit" value="Se connecter" name="connect_form">
    </form>
    <?php
    if (isset($erreur)){
        echo "<div>".$erreur."</div>";
    }
    ?>
</div>
</body>
</html>
