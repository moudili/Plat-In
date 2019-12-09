<?php
 
    function CheckOrigine()
    {
        if($_GET['Request'] == "Ajouter"
        || $_GET['Request'] == "Modifier cette origine"
        || $_GET['Request'] == "Search")
        {
            if(!empty($_GET['Org']))
            {
                $Org = $_GET['Org'];
                $Org = mb_strtolower($Org,"UTF-8");
                return $Org;
            }
        }
    }

    require('Controller/ControllerStaple.php');
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

        $Origins = SearchOrigin($Org);
        
    }
    require("View/ViewOrigins.php");


?>