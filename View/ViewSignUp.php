<html>
    <head>
        <title>Inscription</title>
    </head>
    
    <body>
        <div>
            <img src="../Pictures/Logo.png">
            <form action='../Recipe.php' method='get'>
            <input type="text" value="Rechercher une recette"/>
            <input type='submit' value=" "></form>
            <form action='../SignUp.php' method='get'>
            <input type='submit' value="Inscription"></form>
            <form action='../SignIn.php' method='get'>
            <input type='submit' value="Connexion"></form>
        </div>
        <!--affiche le menu -->
        <div>
            <form action='../Index.php' method='get'>
            <input type='submit' value="Accueil"></form>
            <form action='../Recipe.php' method='get'>
            <input type='submit' value="Recette"></form>
            <form action='../Event.php' method='get'>
            <input type='submit' value="Evènement"></form>
            <form action='../Profile.php' method='get'>
            <input type='submit' value="Profile"></form>
            <form action='../Social.php' method='get'>
            <input type='submit' value="Sociale"></form>            
        </div>
            <?php

            if (empty($_GET['go'])) 
            {
                echo("<form action='ViewSignUp.php' method='get'>
                    <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value=''></p>
                    <p>Prénom : <input id='get_prenom' type='text' name='first_name' value=''></p>
                    <p>Nom : <input id='get_nom' type='text' name='last_name' value=''></p>
                    <p>Adresse : <input id='get_adresse' type='text' name='adresse' value=''></p>
                    <p>Adresse e-mail : <input id='get_mail' type='e-mail' name='mail' value=''></p>
                    <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value=''></p>
                    <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value=''></p>
                    <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value=''></p>
                    <p><input id='hidden' name='go' type='hidden' value='fini'></p>
                    <input type='submit' value='Inscription'>
                    </form>");
            } else if ($_GET['go'] == 'fini')
            {
                
                require('../Controller/ControllerSignUp.php');
                CheckMdp();
                if ($_SESSION["create"]== true) 
                {
                    require('ViewSignUpGood.php');
                } else 
                {
                    echo($_SESSION["erreur"]);
                    echo("<form action='ViewSignUp.php' method='get'>
                    <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value='".$_GET['ndu']."'></p>
                    <p>Prénom : <input id='get_prenom' type='text' name='first_name' value='".$_GET['first_name']."'></p>
                    <p>Nom : <input id='get_nom' type='text' name='last_name' value='".$_GET['last_name']."'></p>
                    <p>Adresse : <input id='get_adresse' type='text' name='adresse' value='".$_GET['adresse']."'></p>
                    <p>Adresse e-mail : <input id='get_mail' type='e-mail' name='mail' value='".$_GET['mail']."'></p>
                    <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value='".$_GET['phone']."'></p>
                    <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value=''></p>
                    <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value=''></p>
                    <p><input id='hidden' name='go' type='hidden' value='fini'></p>
                    <input type='submit' value='Inscription'>
                    </form>");
                }
            };

            ?>
        </div>
        
    </body>
</html>