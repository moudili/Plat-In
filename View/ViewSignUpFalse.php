<html>
    <head>
        <title>False Inscription</title>
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

        $Ndu = $_GET['ndu'];
        $FirstName = $_GET['first_name'];
        $LastName = $_GET['last_name'];
        $Adresse = $_GET['adresse'];
        $Mail = $_GET['mail'];
        $Phone = $_GET['phone'];
        $Mdp = $_GET['mdp'];
        $Cmdp = $_GET['cmdp'];
      
        echo($_SESSION["erreur"]);
        
        require('../View/ViewSignUp.php');

        session_destroy();
        ?>
    </body>
</html>