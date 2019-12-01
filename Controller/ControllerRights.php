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

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
   
    $User = CheckUser();
    require('Model/ModelRights.php');
    $Search = SearchUser($User);
    Ban();
    UnBan();
    $CheckRights = ManageRights();
    
    require("View/ViewRights.php");

?>
