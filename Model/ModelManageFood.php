<?php
    function BDDChange($org)
    {

        if(isset($_GET['ModifierAliment'])==TRUE)
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd->prepare("UPDATE foods SET food_name=:food_name WHERE ID_food=:ID");
            $Req->bindParam(':food_name', $org, PDO::PARAM_STR);
            $Req->bindParam(':ID', $_GET['ModifierAliment'], PDO::PARAM_STR);
            $Req->execute();
        }
        elseif(isset($_GET['SupprimerAliment'])==TRUE)
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd->prepare("DELETE FROM foods WHERE ID_food=:ID");
            $Req->bindParam(':ID', $_GET['SupprimerAliment'], PDO::PARAM_STR);
            $Req->execute();
        }
        elseif(isset($_GET['TextAddFood'])==TRUE)
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd->prepare("INSERT INTO foods (ID_food, food_name)  VALUES (NULL, :FoodName)");
            $Req->bindParam(':FoodName', $org, PDO::PARAM_STR);
            $Req->execute();
        }
    }

    function BDDFood()
    {
        if(empty($_GET['Request']) == TRUE)
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd->prepare("SELECT ID_food,food_name FROM foods");
            $Req->execute();
            $Aliments = $Req->fetchAll();
            
            return $Aliments;
        }
    }
    
    function SearchOrigin($Org)
    {
        if($_GET['Request'] == "Search")
        {
            require("Model/ModelNewPDO.php");
            if(empty($_GET['Org']))
            {
                $Req = $Bdd -> prepare("SELECT ID_origin,origin_name FROM origins");
                $Req -> execute();
                $Origins = array(array(),array());
                while($n = $Req -> fetch())
                {
                    array_push($Origins[0], $n[0]);
                    array_push($Origins[1], $n[1]);               
                }
            }
            else
            {
                $Req = $Bdd -> prepare('SELECT ID_origin,origin_name FROM origins WHERE origin_name LIKE "%'.$Org.'%" ');
                $Req -> execute();
                $Origins = array(array(),array());
                if($Req->rowCount() > 0)
                {
                    while($n = $Req -> fetch())
                    {
                        array_push($Origins[0], $n[0]);
                        array_push($Origins[1], $n[1]);               
                    }
                }
                else
                {
                    $Origins = false;
                }
            }
            return $Origins;
        }
    }
?>