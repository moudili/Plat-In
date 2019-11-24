<?php

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelManageFood.php');
    $Aliments = BDDFood();
    require("View/ViewManageFood.php");

?>