<html>
    <head>
        <title>Inscription</title>
    </head>
    
    <body>
        <?php
        if (empty($_GET['go']))
        {
            echo("<form action='SignUp.php' method='get'>
            <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value=''></p>
            <p>Prénom : <input id='get_prenom' type='text' name='first_name' value=''></p>
            <p>Nom : <input id='get_nom' type='text' name='last_name' value=''></p>
            <p>Adresse : <input id='get_adresse' type='text' name='adresse' value=''></p>
            <p>Adresse e-mail : <input id='get_mail' type='e-mail' name='mail' value=''></p>
            <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value=''></p>
            <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value=''></p>
            <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value=''></p>
            <input type='submit' value='Inscription' name='go'>
            </form>
            </div>");
        } else if (!empty($_GET['go']))
        {
            if ($_SESSION["create"]==true) {
                echo("Tu as reussi a t'inscrire, ton nom d'utilisateur est : ".$_GET['ndu']." Et ton mot de passe : ".$_GET['mdp']."<br>
                <a href='Index.php'><input type='button' value='Retour accueil'></a>");
            } else if ($_SESSION["create"]==false)
            {
                echo($_SESSION['erreur']."<br><form action='SignUp.php' method='get'>
                <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value='".$_GET['ndu']."'></p>
                <p>Prénom : <input id='get_prenom' type='text' name='first_name' value='".$_GET['first_name']."'></p>
                <p>Nom : <input id='get_nom' type='text' name='last_name' value='".$_GET['last_name']."'></p>
                <p>Adresse : <input id='get_adresse' type='text' name='adresse' value='".$_GET['adresse']."'></p>
                <p>Adresse e-mail : <input id='get_mail' type='e-mail' name='mail' value='".$_GET['mail']."'></p>
                <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value='".$_GET['phone']."'></p>
                <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value='".$_GET['mdp']."'></p>
                <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value='".$_GET['cmdp']."'></p>
                <input type='submit' value='Inscription' name='go'>
                </form>
                </div>");
            }
        }
        
        ?>
        
    </body>
</html>