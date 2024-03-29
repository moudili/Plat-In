<?php

    /* set la variable de session co a false si elle n'existe pas */

    function CheckSesion()
    {
        session_start();
        if(empty($_SESSION['Co']))
        {
            $_SESSION['Co']=false;
        }
    }

    /* si la personne n'est pas connecté cela la renvoie vers une autre page ou il y a deux liens pour se connecter ou s'incrire*/

    function CheckCo()
    {
        if($_SESSION['Co']==false)
        {
            require('View/ViewErreurConnexion.php');
        }
    }


    /* Si l'utiliateur se déconnecte detruit sa session, le met en dc dans la bdd et le renvoi sur la page d'accueil */

    function CheckLogOut()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "LogOut")
            {
                require('Model/ModelLogOut.php');
                session_destroy();
                header("Location:Index.php");
            }
        }
    }


?>
