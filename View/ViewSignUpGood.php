<html>
    <head>
        <title>Inscription Réussi</title>
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
        echo("Tu as reussi a t'inscrire, ton nom d'utilisateur est : ".$_GET['ndu']." Et ton mot de passe : ".$_GET['mdp']."<br>
        <a href='../Index.php'><input type='button' value='Retour accueil'></a>");
        session_destroy();
        ?>
    </body>
</html>