<?php
    require("View/ViewBanner.php");
    ?>
<html>
    <head>
        <title>Connexion</title>
        <link rel="stylesheet" href="Css/Bootstrap/PersonalCss.css">
        <link rel="stylesheet" href="Css/Bootstrap/background.css">
        <link rel="stylesheet" href="Css/Bootstrap/rating.css">
    </head>
    <body class='backgroundhat center'>
    <div class='arriereplan'>
    <h1>Connexion</h1>
    <?php
    if(empty($Query) 
        && empty($Check) 
        && empty($_GET['Request']))
    {
        echo("<div><form action='Index.php' method='get'>
        <input type='text' name='User'/>
        <p><input type='password' name='Pwd'/></p>
        <p><input type='hidden' name='page' value='Connexion'></p>
        <input type='submit' name='Request' value='Se Connecter'></form></div>");
    }
    else
    {   
        if(empty($Query) 
            && empty($Check))
        {
            
            /* un des deux champs est vide */

            echo("<div><form action='Index.php' method='get'> 
            <input type='text' name='User'value='".htmlspecialchars($_GET['User'], ENT_QUOTES)."'/></p>
            <p> <input type='password' name='Pwd' value='".htmlspecialchars($_GET['Pwd'], ENT_QUOTES)."'/></p>
            <input type='hidden' name='page' value='Connexion'>
            <FONT color='red'>veuillez remplir tous les champs</FONT><br>
            <input type='submit' name='Request' value='Se Connecter'></form></div>");
        }
        else if(!empty($Status_u) && $Status_u == "ban")
        {
            echo"Votre compte a été banni il vous est donc impossible de vous connecté";
        }
        else
        {

            /* Ce compte n'existe pas */
            
            echo("<div><form action='Index.php' method='get'> 
            <input type='text' name='User'value='".htmlspecialchars($_GET['User'], ENT_QUOTES)."'/></p>
            <p> <input type='password' name='Pwd' value='".htmlspecialchars($_GET['Pwd'], ENT_QUOTES)."'/></p>
            <input type='hidden' name='page' value='Connexion'>
            <FONT color='red'>Désolé, cette combinaison de nom d'utilisateur et de mot de passe n'a pas pu être trouvée.</FONT><br>
            <input type='submit' name='Request' value='Se Connecter'></form></div>");
        }
    }
    ?>
    </div>
    </body>
</html> 