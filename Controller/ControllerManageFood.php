<?php

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
    require("View/ViewBanner.php");
    require('Model/ModelManageFood.php');
    $Aliments = BDDFood();

    require('Controller/ControllerManageFood.php');
    require("View/ViewManageFood.php");


?>
