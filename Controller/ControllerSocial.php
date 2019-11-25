<?php
                          
    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
    CheckCo2();

    if ($_SESSION['Co']==true)
    {
        require("View/ViewSocial.php");
    }
?>
       