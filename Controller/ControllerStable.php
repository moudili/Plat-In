<html>
    <head>
    </head>
    <body>
        <?php
            //set la variable de session co a false si elle n'existe pas
            function CheckSesion()
            {
                session_start();
                if(empty($_SESSION['Co']))
                {
                    $_SESSION['Co']=false;
                }
            }
            //affiche la banner en fonction de si l'utilisateur est un visiteur ou un membre
            function CheckCo()
            {
                if($_SESSION['Co']==false)
                {
                    require('View\ViewBannerVisitor.php');
                }
                else{
                    
                }
            }
        ?>
    </body>
</html> 