<?php

    function CheckOrigine()
    {
        if($_GET['Request'] == "Ajouter"
        || $_GET['Request'] == "Modifier cette origine")
        {
            if(!empty($_GET['Org']))
            {
                $Org = $_GET['Org'];
                $Org = strtolower($Org);
                return $Org;
            }
        }
    }

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelOrigins.php');
    $Origins = Origins();
    if(!empty($_GET['Request']))
    {
        $Org = CheckOrigine();
        
    $CheckFormAdd = CheckForm ($Org);
        
        DeletOrigin();
        
        $CheckFormUpdate = ModifOrigin($Org);
        
    }
    require("View/ViewOrigins.php");


?>