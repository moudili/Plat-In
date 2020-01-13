<?php

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    CheckCo();

    if ($_SESSION['Co']==true)
    {
        require("Model/ModelEvent.php");
        $Events=SelectEvent();
        require("View/ViewEvent.php");
    }
?>
       