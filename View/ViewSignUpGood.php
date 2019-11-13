<html>
    <head>
        <title>Inscription Réussi</title>
    </head>
    
    <body>
        <?php 
        echo("Tu as reussi a t'inscrire, ton nom d'utilisateur est : ".$_GET['ndu']." Et ton mot de passe : ".$_GET['mdp']."<br>
        <a href='..\Index.php'><input type='button' value='Retour accueil'></a>");
        ?>
    </body>
</html>