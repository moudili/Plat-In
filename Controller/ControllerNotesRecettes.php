<?php

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    
    require('Model/ModelNotesRecettes.php');
    $Recipes=Recipe();
    $Note=PrintStarts();
    require("View/ViewNotesRecettes.php");
?>