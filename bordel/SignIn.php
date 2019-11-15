<html>
    <head>
        <title>Connexion</title>
    </head>
    <body>
        <?php

           /* fichiers exportés:
            ControllerStable.php
            ControllerSignIn.php
            ModelSignIn.php
            */

            require('Controller/ControllerStable.php');
            CheckSesion();
            CheckCo();
            require('Controller/ControllerSignIn.php');
            FirstView();
            $Query = GetQuery();
            require('Model/ModelSignIn.php');
            $Check = CheckIdent($Query);
            GetID($Check);
            ConBDD($Check);
            Con($Check,$Query);        
        ?>
    </body>
</html>        