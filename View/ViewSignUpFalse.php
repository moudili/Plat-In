<html>
    <head>
        <title>False Inscription</title>
    </head>
    
    <body>
    <div>
            <img src="../Pictures/Logo.png">
            <form action='Recipe.php' method='get'>
            <input type="text" value="Rechercher une recette"/>
            <input type='submit' value=" "></form>
            <form action='SignUp.php' method='get'>
            <input type='submit' value="Inscription"></form>
            <form action='SignIn.php' method='get'>
            <input type='submit' value="Connexion"></form>
        </div>
        <!--affiche le menu -->
        <div>
            <form action='Index.php' method='get'>
            <input type='submit' value="Accueil"></form>
            <form action='Recipe.php' method='get'>
            <input type='submit' value="Recette"></form>
            <form action='Event.php' method='get'>
            <input type='submit' value="Evènement"></form>
            <form action='Profile.php' method='get'>
            <input type='submit' value="Profile"></form>
            <form action='Social.php' method='get'>
            <input type='submit' value="Sociale"></form>            
        </div>
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
        
        <form action='../Controller/ControllerSignUp.php' method='get'>
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