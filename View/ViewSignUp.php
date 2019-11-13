<html>
    <head>
        <title>Inscription</title>
    </head>
    
    <body>
        <div>
            <?php
            
            if (empty($_GET['go'])) 
            {
                echo("<form action='View\ViewSignUp.php' method='get'>
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
                require('..\Controller\ControllerSignUp.php');
                CheckMdp();
                if ($_SESSION["create"]== true) 
                {
                    require('..\View\ViewSignUpGood.php');
                } else 
                {
                    require('..\View\ViewSignUpFalse.php');
                }
            }

            ?>
        </div>
        
    </body>
</html>