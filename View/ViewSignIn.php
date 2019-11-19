<html>
    <head>
        <title>Connexion</title>
    </head>
    <body>
    <h1>Connexion</h1>
    <form action='SignIn.php' method='get'>
    <?php
    if(empty($Query) 
        && empty($Check) 
        && empty($_GET['Request']))
    {
        echo("<p> <input type='text' name='User'/></p>
        <p> <input type='password' name='Pwd'/></p>
        <input type='submit' name='Request' value='Se Connecter'></form>");
    }
    else
    {
        echo("<p> <input type='text' name='User'value='".$_GET['User']."'/></p>
        <p> <input type='password' name='Pwd' value='".$_GET['Pwd']."'/></p>");
        
        if(empty($Query) 
            && empty($Check))
        {
            
            /* un des deux champs est vide */

            echo("<FONT color='red'>veuillez remplir tous les champs</FONT><br>
            <input type='submit' name='Request' value='Se Connecter'></form>");
        }
        else
        {

            /* Ce compte n'existe pas */
            
            echo("<FONT color='red'>Désolé, cette combinaison de nom d'utilisateur et de mot de passe n'a pas pu être trouvée.</FONT><br>
            <input type='submit' name='Request' value='Se Connecter'></form>");
        }
    }
    ?>
    </body>
</html> 