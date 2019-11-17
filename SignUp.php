<html>
    <head>
        <title>Inscription</title>
    </head>
    <body>
        <?php
        
            /* fichiers exportés:
            ControllerStable.php
            View/ViewBanner.php
            Controller/ControllerSignUp.php
            Model/ModelSignUp.php
            View/ViewSignUp.php
            */
            
            require('Controller/ControllerStable.php');
            CheckSesion();
            require("View/ViewBanner.php");
            require('Controller/ControllerSignUp.php');
            $Data = CheckField();
            require('Model/ModelSignUp.php');
            $CheckUser = ModelSignUp($Data[0],$Data[1],$Data[2],$Data[3],$Data[4],$Data[5],$Data[6],$Data[7]);
            CheckUser($CheckUser,$Data[7]);
            require("View/ViewSignUp.php");
            CleanVariable();
        ?>
    </body>
</html>        