<html>
    <head>
        <title>False Inscription</title>
    </head>
    
    <body>
        <?php 
        $Ndu = $_GET['ndu'];
        $FirstName = $_GET['first_name'];
        $LastName = $_GET['last_name'];
        $Adresse = $_GET['adresse'];
        $Mail = $_GET['mail'];
        $Phone = $_GET['phone'];
        $Mdp = $_GET['mdp'];
        $Cmdp = $_GET['cmdp'];

        echo($_SESSION["erreur"]."
        
        <form action='..\Controller\ControllerSignUp.php' method='get'>
        <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value='".$Ndu."'></p>
        <p>Prénom : <input id='get_prenom' type='text' name='first_name' value='".$FirstName."'></p>
        <p>Nom : <input id='get_nom' type='text' name='last_name' value='".$LastName."'></p>
        <p>Adresse : <input id='get_adresse' type='text' name='adresse' value='".$Adresse."'></p>
        <p>Adresse e-mail : <input id='get_mail' type='e-mail' name='mail' value='".$Mail."'></p>
        <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value='".$Phone."'></p>
        <p>Mot de passe : <input id='get_mdp' type='text' name='mdp' value='".$Mdp."'></p>
        <p>Confirmation de mot de passe : <input id='get_cmdp' type='text' name='cmdp' value='".$Cmdp."'></p>
        <input type='submit' value='Inscription'>
        </form>");
        ?>
    </body>
</html>