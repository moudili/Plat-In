<?php

    /* affiche le formulaire connexion une première fois */

    function FirstView()
    {
        if(empty($_GET['Request']))
        {
            require("View/ViewSignIn.php");
        }
    }

    /* vérifie que l'utilisateur a rempli tous les champs après avoir appuyer sur connexion
    autrement raffiche le formulaire avecd un message d'erreur*/

    function GetQuery()
    {
        if(!empty($_GET['Request']))
        {   
            if(empty($_GET['User']) 
                || empty($_GET['Pwd']))
            {
                $Query = false;
                require('View/ViewSignIn.php');
            }
            else
            {
                $_SESSION['User'] = $_GET['User'];
                $_SESSION['Pwd'] = $_GET['Pwd'];
                $_SESSION['Pwd'] = base64_encode($_SESSION['Pwd']);
                $Query = true;
            }
            return $Query;
        }
    }

    /* vérifie les champs si ils sont rempli et si le compte de l'utilisateur est dans la bdd le connecte */

    function Con($Check,$Query)
    {
        if(!empty($_GET['Request'])
            && $Query == true)
        {
            if($Check == 1 && $_SESSION['status_u'] != "ban")
            {   
                $_SESSION['Co'] = true;
                unset($_SESSION['Pwd']);
                header("Location:Index.php");
            }
            else
            {
                $Status_u = "ban";
                require('View/ViewSignIn.php'); 
            }
        }
    }

        require('ControllerStaple.php');
        CheckSesion();
        FirstView();
        $Query = GetQuery();
        require('Model/ModelSignIn.php');
        $Check = CheckIdent($Query);
        GetID($Check);
        ConBDD($Check);
        Con($Check,$Query); 

?>