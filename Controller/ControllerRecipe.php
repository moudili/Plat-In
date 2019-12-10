<?php
               
    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelRecipe.php');
    $Origines=Origin();
    //echo($_SESSION['id']);
    $CheckForm=InsertRecipe();
    //echo($CheckForm);
    require("View/ViewRecipe.php");
?>     