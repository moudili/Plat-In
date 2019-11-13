<html>
    <head>
        <title>Inscription</title>
    </head>
    <body>
        <?php
            // exporte Stable.php et appelle des fonctions
            require('Controller\ControllerStable.php');
            CheckSesion();
            CheckCo();
            require('View\ViewSignUp.php');
        ?>
    </body>
</html>        