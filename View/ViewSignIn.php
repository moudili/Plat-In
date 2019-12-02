<html>
    <head>
        <title>Connexion</title>
    </head>
    <body>

    <?php
    require("View/ViewBanner.php");
    ?>
    <div class="text-center mt-5">
    <h1>Connexion</h1>
    <?php
    if(empty($Query) 
        && empty($Check) 
        && empty($_GET['Request']))
    {
        echo("<p><form action='Index.php' method='get'>
        <input type='text' name='User'/></p>
        <p> <input type='password' name='Pwd'/></p>
        <input type='hidden' name='page' value='Connexion'>
        <input type='submit' name='Request' value='Se Connecter'></form>");
    }
    else
    {   
        if(empty($Query) 
            && empty($Check))
        {
            
            /* un des deux champs est vide */

            echo("<p><form action='Index.php' method='get'> 
            <input type='text' name='User'value='".htmlspecialchars($_GET['User'], ENT_QUOTES)."'/></p>
            <p> <input type='password' name='Pwd' value='".htmlspecialchars($_GET['Pwd'], ENT_QUOTES)."'/></p>
            <input type='hidden' name='page' value='Connexion'>
            <FONT color='red'>veuillez remplir tous les champs</FONT><br>
            <input type='submit' name='Request' value='Se Connecter'></form>");
        }
        else if(!empty($_SESSION['status_u']) && $_SESSION['status_u'] == "ban")
        {
            echo"Votre compte a été banni il vous est donc impossible de vous connecté";
        }
        else
        {

            /* Ce compte n'existe pas */
            
            echo("<p><form action='Index.php' method='get'> 
            <input type='text' name='User'value='".htmlspecialchars($_GET['User'], ENT_QUOTES)."'/></p>
            <p> <input type='password' name='Pwd' value='".htmlspecialchars($_GET['Pwd'], ENT_QUOTES)."'/></p>
            <input type='hidden' name='page' value='Connexion'>
            <FONT color='red'>Désolé, cette combinaison de nom d'utilisateur et de mot de passe n'a pas pu être trouvée.</FONT><br>
            <input type='submit' name='Request' value='Se Connecter'></form>");
        }
    }
    ?>
    </div>
    </body>
</html> 