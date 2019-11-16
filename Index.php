<html>
    <head>
        <title>Plat'In</title>
    </head>
    <body>
        <?php
            
            /* fichiers exportés:
            ControllerStable.php
            */

            require('Controller/ControllerStable.php');
            CheckSesion();
            require("View/ViewBanner.php");
            CheckLogOut();

        ?>
    </body>
</html>        