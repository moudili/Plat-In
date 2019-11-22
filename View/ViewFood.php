<html>
    <head>
        <title>Aliments</title>
    </head>
    
    <body>
        <?php
            
            require("View/ViewBanner.php");     
        
        ?>
    </body>
</html>

<html>
    <head>
        <title>Aliments</title>
    </head>
    <body>
        <?php
            
            /* fichiers exportés:
            ControllerStable.php
            */

            require('Controller/ControllerStable.php');
            CheckSesion();
            require("View/ViewBanner.php");
            require('Model/ModelManageFood.php');
            $Aliments = BDDFood();
            
            require('Controller/ControllerManageFood.php');
            require("View/ViewManageFood.php");

        ?>
    </body>
</html>