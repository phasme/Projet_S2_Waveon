<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'cnx.php';

if (isset($_SESSION['USER_ID'])){
    $requsr = $bdd->prepare("SELECT * FROM user_person WHERE USER_ID = ?");
    $requsr->execute(array($_SESSION['USER_ID']));
    $user = $requsr->fetch();

    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['USERNAME']){
        $newpseudo=htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $bdd->prepare("UPDATE user_person SET USERNAME = ? WHERE USER_ID = ?");
        $insertpseudo->execute(array($newpseudo, $_SESSION['USER_ID']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['MAIL']){
        $newmail=htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE user_person SET MAIL = ? WHERE USER_ID = ?");
        $insertmail->execute(array($newmail, $_SESSION['USER_ID']));
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND ($_POST['newmdp2']) AND !empty($_POST['newmdp2'])){

        $mdp1 = sha1($_POST['newmdp1']);
        $mdp2 = sha1($_POST['newmdp2']);

        if ($mdp1 == $mdp2){
            $insertmdp = $bdd->prepare("UPDATE user_person SET USER_PASSWORD = ? WHERE USER_ID = ?");
            $insertmdp->execute(array($mdp1,$_SESSION['id']));
            header("Location: profil.php?id=".$_SESSION['id']);
        }else{
            $msg = "Les mots de passe ne correspondent pas";
        }
    }
    if (isset($_POST['newpseudo']) AND $_POST['newpseudo'] == $user['USERNAME']){
        header("Location: profil.php?id=".$_SESSION['id']);
    }

    ?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Votre profil - Waveon</title>
        <link rel="stylesheet" href="../css/styles_graphique.css">
        <link rel="stylesheet" href="../css/styles_mise_en_page.css">
        <link rel="stylesheet" href="../css/typographie.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
    </head>
    <body class="edit">
    <header>
        <div class="navbar">
            <a href="../index.html"><img src="../img/logo.svg" alt="logo"></a>
        </div>
    </header>
    <div class="formulaire">
        <h2>Editer mon profil</h2>
        <form method="post" action="">
            <label for="">Modifier votre pseudo :</label>
            <input type="text" name="newpseudo" placeholder="Saisissez votre nouveau pseudo" value="<?php echo $user['USERNAME'] ?>">

            <label for="">Modifier votre mail :</label>
            <input type="email" name="newmail" placeholder="Saisissez votre nouveau mail" value="<?php echo $user['MAIL'] ?>">

            <label for="">Modifier votre mot de passe :</label>
            <input type="password" name="newmdp1" placeholder="Saisissez votre nouveau mot de passe">

            <label for="">Confirmez votre nouveau mot de passe:</label>
            <input type="password" name="newmdp2" placeholder="Confirmez votre nouveau mot de passe">

            <input class="btn_m" type="submit" value="Enregistrer">
        </form>
        <?php
        if (isset($msg)){ echo $msg;}
            ?>
    </div>
    </body>
    </html>
    <?php
}
else{
    header('Location: connexion.php');
}
?>
<!-- pour afficher l'image <img src="php/images/<?php /*$_SESSION['PROFIL_PICTURE'] */?>" alt="">-->
