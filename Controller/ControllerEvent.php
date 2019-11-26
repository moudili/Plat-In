<?php

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
    CheckCo();

    if ($_SESSION['Co']==true)
    {
        require("View/ViewEvent.php");
    }
?>
       