<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bdd = new PDO('mysql:host=localhost;dbname=waveon', 'root', '');

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
    <title>Votre profil - Waveon</title>
    <link rel="stylesheet" href="../css/styles_graphiques.css">
    <link rel="stylesheet" href="../css/styles_mise_en_page.css">
    <link rel="stylesheet" href="../css/typographie.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div>
    <h2>Profil de <?php echo $userinfo['USERNAME'] ?> </h2>
    <p>NOM : <?php echo $userinfo['LASTNAME'] ?> </p>
    <p>Prénom : <?php echo $userinfo['FIRSTNAME'] ?> </p>
    <p>Pseudo : <?php echo $userinfo['USERNAME'] ?> </p>
    <?php
    if (isset($_SESSION['USER_ID']) AND $userinfo['USER_ID'] == $_SESSION['USER_ID']){
    ?>
        <a href="#">Editer mon profil</a>
        <a href="deconnexion.php">Se déconnecter</a>
    <?php
    }
    ?>
</div>
</body>
</html>
<?php
}
/*
else{
    header('Location: connexion.php');
}*/
?>
<!-- pour afficher l'image <img src="php/images/<?php /*$_SESSION['PROFIL_PICTURE'] */?>" alt="">-->