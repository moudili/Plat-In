<html>
    <head>
        <title>Inscription</title>
    </head>
    <body>
        <?php
        
            /* fichiers expotés:
            ControllerStable.php
            */
            require('Controller/ControllerStable.php');
            CheckSesion();
            CheckCo();
            require('Controller/ControllerSignUp.php');
            CheckMdp();     
            require("View/ViewSignUp.php");
        ?>
    </body>
</html>        