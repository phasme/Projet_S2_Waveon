<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'cnx.php';

if (isset($_POST['inscr_form'])){

    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail_conf = htmlspecialchars($_POST['mail_conf']);
    $mdp = sha1($_POST['mdp']);
    $mdp_conf = sha1($_POST['mdp_conf']);

    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail_conf']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp_conf'])){
        $nomlength = strlen($nom);
        $prenomlength = strlen($prenom);
        $pseudolength = strlen($pseudo);
        if ($nomlength<=255 && $nomlength>2){
            if ($prenomlength<=255 && $prenomlength>2){
                if ($pseudolength<=255){
                    if($mail==$mail_conf){
                        if (filter_var($mail, FILTER_VALIDATE_EMAIL)){
                            $reqmail= $bdd->prepare("SELECT * FROM user_person WHERE MAIL = ?");
                            $reqmail->execute(array($mail));
                            $mailexist = $reqmail->rowCount();
                            if($mailexist == 0) {
                                if ($mdp == $mdp_conf) {
                                    $insertuser = $bdd->prepare("INSERT INTO user_person(LASTNAME,FIRSTNAME,MAIL,USER_PASSWORD,USERNAME) VALUES(?,?,?,?,?)");
                                    $insertuser->execute(array($nom, $prenom, $mail, $mdp, $pseudo));
                                    $erreur = "Compte créé avec succès";
                                header('Location: connexion.php');
                                } else {
                                    $erreur = "Les deux mots de passes ne correspondent pas";
                                }
                            }else{
                                $erreur= "Adresse mail déjà existante";
                            }
                        }else{
                            $erreur = "L'adresse mail saisie n'est pas valide";
                        }
                    }else{
                        $erreur="Les deux adresses mail ne se correspondent pas";
                    }
                }else{
                    $erreur="Votre pseudo est trop long";
                }
            }elseif ($prenomlength<2){
                $erreur="Le prénom saisi est trop court";
            }else{
                $erreur="Le prénom saisi est trop long";
            }
        }elseif ($nomlength<2){
            $erreur="Le nom saisi est trop court";
        }else{
            $erreur="Le nom saisi est trop long";
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
    <title>Inscription  à Waveon</title>
    <link rel="stylesheet" href="../css/styles_graphiques.css">
    <link rel="stylesheet" href="../css/styles_mise_en_page.css">
    <link rel="stylesheet" href="../css/typographie.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<div>

    <h2>Inscription</h2>
    <form method="POST" action="">
        <label for="nom">Quel est votre nom ?</label>
        <input type="text" id="nom" placeholder="Saisissez votre nom" name="nom">

        <label for="prenom">Quel est votre prénom ?</label>
        <input type="text" id="prenom" placeholder="Saisissez votre prénom" name="prenom">

        <label for="mail">Quel est votre adresse mail ?</label>
        <input type="email" id="mail" placeholder="Saisissez votre adresse mail" name="mail">

        <label for="mail_conf">Confirmez votre adresse mail </label>
        <input type="email" id="mail_conf" placeholder="Confirmez votre adresse mail" name="mail_conf">

        <label for="mdp">Saisissez votre mot de passe</label>
        <input type="password" id="mdp" placeholder="Saisissez votre mot de passe" name="mdp">

        <label for="mdp_conf">Confirmez votre mot de passe</label>
        <input type="password" id="mdp_conf" placeholder="Confirmez votre mot de passe" name="mdp_conf">

        <label for="pseudo">Quel est votre pseudo ?</label>
        <input type="text" id="pseudo" placeholder="Saisissez votre pseudo" name="pseudo">

        <input type="submit" value="S'inscrire" name="inscr_form">
    </form>
    <?php
    if (isset($erreur)){
        echo "<div>".$erreur."</div>";
    }
    ?>
</div>
</body>
</html>
