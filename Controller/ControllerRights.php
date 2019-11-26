<?php

    function CheckUser()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Search")
            {
                $Usr = $_GET['Usr'];
                $Usr = strtolower($Usr);
                return $Usr;
            }
        }
    }

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
   
    $User = CheckUser();
    require('Model/ModelRights.php');
    $Search = SearchUser($User);
    require("View/ViewRights.php");

?>
