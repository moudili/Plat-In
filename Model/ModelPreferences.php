<?php

    function PrintDiet()
    {
        require('../Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT * FROM diets ");
        $Req -> execute();
        $PrintDiet = array(array(),array());
        
        while($n = $Req -> fetch())
        {
            array_push($PrintDiet[0], $n[0]);
            array_push($PrintDiet[1], $n[1]);
        }

        return $PrintDiet;

    }

?>