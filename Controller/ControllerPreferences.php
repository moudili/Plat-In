<?php
    function CheckMenu()
    {
        if(!empty($_GET['Request']) && $_GET['Request'] == '+')
        {
            $Menu = $_GET['Menu'] + 1;
            return $Menu;
        }
        else if(!empty($_GET['Request']) && $_GET['Request'] == '-')
        {
            $Menu = $_GET['Menu'] - 1;
            return $Menu;
        }
    }

    require('../Model/ModelPreferences.php');
    $PrintDiet = PrintDiet();
    $Menu = CheckMenu();
    require('../View/ViewPreferences.php');
?>