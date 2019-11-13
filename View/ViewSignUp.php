<html>
    <head>
        <title>Inscription</title>
    </head>
    
    <body>
        <div>
            <form action='ControllerSignUp.php' method='get'>
                <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value='<?php $ndc ?>'></p>
                <p>Prénom : <input id='get_prenom' type='text' name='first_name' value='<?php $FirstName ?>'></p>
                <p>Nom : <input id='get_nom' type='text' name='last_name' value='<?php $LastName ?>'></p>
                <p>Adresse : <input id='get_adresse' type='text' name='adresse' value='<?php $Adresse ?>'></p>
                <p>Adresse e-mail : <input id='get_mail' type='e-mail' name='mail' value='<?php $Mail ?>'></p>
                <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value='<?php $Phone ?>'></p>
                <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value='<?php $Mdp ?>'></p>
                <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value='<?php $Cmdp ?>'></p>
                <input type='submit' value='Inscription'>
            </form>
        </div>
        <?php 
        ?>
    </body>
</html>