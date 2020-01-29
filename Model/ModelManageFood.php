<?php
    function Foods()
    {
        if(empty($_GET['Request']))
        {
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("SELECT ID_food,food_name FROM foods ORDER BY food_name");
            $Req -> execute();
            $Foods = array(array(),array());
            while($n = $Req -> fetch())
            {
                array_push($Foods[0], $n[0]);
                array_push($Foods[1], $n[1]);               
            }
            
            return $Foods;
        }
    }

    function CheckForm ($Ali) 
    {
        if($_GET['Request'] == "Ajouter")
        {
            if(!empty($_GET['Ali'])
            && strlen($_GET['Ali']) > 2
            && strlen($_GET['Ali']) < 40
            && preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Ali'])
            )
            {
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT count(ID_food) FROM foods WHERE food_name LIKE :food");
                $Req -> bindParam(':food',$Ali,PDO::PARAM_STR);
                $Req -> execute();
                $n = $Req -> fetch();
                $CheckForm = $n[0];

                if($CheckForm == 0)
                {
                    $Req = $Bdd -> prepare("INSERT INTO `foods` (`ID_food`, `food_name`) VALUES (NULL, :food);");
                    $Req -> bindParam(':food',$Ali,PDO::PARAM_STR);
                    $Req -> execute();                    

                }

                return $CheckForm;

            }
        }
    }

    function DeletFood() 
    {
        if($_GET['Request'] == "Supprimer")
        {
            if(!empty($_GET['Answer']))
            {
                $Id = $_GET['id'];
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("DELETE FROM `foods` WHERE `foods`.`ID_food` = :id");
                $Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                $Req -> execute();       

            }
        }
    }

    function ModifFood($Ali)
    {
        if($_GET['Request'] == "Modifier cet aliment")
        {
            if(!empty($_GET['Ali'])
            && strlen($_GET['Ali']) > 2
            && strlen($_GET['Ali']) < 40
            && preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Ali'])
            )
            {
                $Id = $_GET['id'];
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT count(ID_food) FROM foods WHERE food_name LIKE :food");
                $Req -> bindParam(':food',$Ali,PDO::PARAM_STR);
                $Req -> execute();
                $n = $Req -> fetch();
                $CheckForm = $n[0];

                if($CheckForm == 0)
                {
                    $Req = $Bdd -> prepare("UPDATE `foods` SET `food_name` = :food WHERE `ID_food` = :id");
                    $Req -> bindParam(':food',$Ali,PDO::PARAM_STR);
                    $Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                    $Req -> execute();                    

                }

                return $CheckForm;
            }
        }
    }
 
    function SearchFood($Ali)
    {
        if($_GET['Request'] == "Search")
        {
            require("Model/ModelNewPDO.php");
            if(empty($_GET['Ali']))
            {
                $Req = $Bdd -> prepare("SELECT ID_food,food_name FROM foods ORDER BY food_name");
                $Req -> execute();
                $Foods = array(array(),array());
                while($n = $Req -> fetch())
                {
                    array_push($Foods[0], $n[0]);
                    array_push($Foods[1], $n[1]);               
                }
            }
            else
            {
                $Req = $Bdd -> prepare('SELECT ID_food,food_name FROM foods WHERE food_name LIKE "%'.$Ali.'%" ORDER BY food_name');
                $Req -> execute();
                $Foods = array(array(),array());
                if($Req->rowCount() > 0)
                {
                    while($n = $Req -> fetch())
                    {
                        array_push($Foods[0], $n[0]);
                        array_push($Foods[1], $n[1]);               
                    }
                }
                else
                {
                    $Foods = false;
                }
            }
            return $Foods;
        }
    }

?>