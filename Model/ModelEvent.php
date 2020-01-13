<?php

    function SelectEvent()
    {
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT service_name FROM dishes");
        $Req -> execute();
        $Events=array();
        while($n = $Req -> fetch())
        {
            array_push($Events, $n[0]);
        }
        return $Events;
    }

    function AddEvent()
    {

    }
 
    function SelectRecipe()
    {
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT name_r,text,ID_recipes
        FROM recipes 
        ORDER BY name_r");
        $Req -> execute();
        $Recipes = array(array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Recipes[0], $n[0]);
            array_push($Recipes[1], $n[1]);
            array_push($Recipes[2], $n[2]);
        }
        return $Recipes;
    }
?>