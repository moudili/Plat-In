<?php

    function PrintDiet()
    {
        require('../Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT * FROM diets ORDER BY name_d");
        $Req -> execute();
        $PrintDiet = array(array(),array());
        
        while($n = $Req -> fetch())
        {
            array_push($PrintDiet[0], $n[0]);
            array_push($PrintDiet[1], $n[1]);
        }

        return $PrintDiet;

    }

    function PrintFood()
    {
        require('../Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT * FROM foods ORDER BY food_name");
        $Req -> execute();
        $PrintFood = array(array(),array());
        
        while($n = $Req -> fetch())
        {
            array_push($PrintFood[0], $n[0]);
            array_push($PrintFood[1], $n[1]);
        }

        return $PrintFood;        
    }
?>