<?php

    function SelectEvent()
    { 
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT name_m FROM meals");
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

    function SelectUser()
    {
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT ID_user,user,status_u
        FROM users 
        WHERE ID_user NOT LIKE :id
        AND status_u NOT LIKE 'admin'
        ORDER BY user");
        $Req -> bindParam(':id',$_SESSION['id'],PDO::PARAM_STR);
        $Req -> execute();
        $Users = array(array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Users[0], $n[0]);
            array_push($Users[1], $n[1]);
            array_push($Users[2], $n[2]);
        }
        return $Users;
    }

    function InsertEvent()
    {
        if (!empty($_GET['Request']) AND $_GET['Request'] == "Confirmer")
        {
            echo("CHATE");
            require('Model\ModelNewPDO.php');
            $Req = $Bdd -> prepare("INSERT INTO `meals` (`name_m`, `date_m`) VALUES (:name_e, :date_e);");
            $Req -> bindParam(':name_e',$_GET['Name'],PDO::PARAM_STR);
            $Req -> bindParam(':date_e',$_GET['date'],PDO::PARAM_INT);
            $Req -> execute();
        }
    }
?>