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
?>