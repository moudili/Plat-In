<html>
    <head>
        <title>Connexion</title>
    </head>
    <body>
        <?php
            // exporte Stable.php et appelle des fonctions
            require('Controller/ControllerStable.php');
            CheckSesion();
            CheckCo();
            require("View/ViewSignIn.php");
        ?>
    </body>
</html>        