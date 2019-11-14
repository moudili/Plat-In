<html>
    <head>
        <title>Plat'In</title>
    </head>
    <body>
        <?php
            
            /* fichiers expotés:
            ControllerStable.php
            */

            require('Controller/ControllerStable.php');
            CheckSesion();
            CheckCo();
            CheckLogOut();
        ?>
    </body>
</html>        