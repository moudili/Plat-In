<?php

function CheckFood()
{
    if($_GET['Request'] == "Ajouter"
    || $_GET['Request'] == "Modifier cet aliment"
    || $_GET['Request'] == "Search")
    {
        if(!empty($_GET['Ali']))
        {
            $Ali = $_GET['Ali'];            
            $Ali = mb_strtolower($Ali,"UTF-8");
            return $Ali;
        }
    }
}

require('Controller/ControllerStaple.php');
CheckSesion();
CheckLogOut();
require('Model/ModelManageFood.php');
$Foods = Foods();
if(!empty($_GET['Request']))
{
    $Ali = CheckFood();
    
    $CheckFormAdd = CheckForm ($Ali);

    DeletFood();
    
    $CheckFormUpdate = ModifFood($Ali);

    $Foods = SearchFood($Ali);
    
}
require("View/ViewManageFood.php");

?>