<?php
    function BDDFood()
    {
        
        if(isset($_GET['ModifierAliment'])==TRUE)
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd->prepare("UPDATE foods SET food_name=:food_name WHERE ID_food=:ID");
            $Req->bindParam(':food_name', $_GET['TextChangeFood'], PDO::PARAM_STR);
            $Req->bindParam(':ID', $_GET['ModifierAliment'], PDO::PARAM_STR);
            $Req->execute();
        }

        if(isset($_GET['SupprimerAliment'])==TRUE)
        {
            
            require('Model/ModelNewPDO.php');
            $Req = $Bdd->prepare("DELETE FROM foods WHERE ID_food=:ID");
            echo($_GET['SupprimerAliment']);
            $Req->bindParam(':ID', $_GET['SupprimerAliment'], PDO::PARAM_STR);
            $Req->execute();
        }

        if(isset($_GET['TextAddFood'])==TRUE)
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd->prepare("INSERT INTO foods (ID_food, food_name)  VALUES (NULL, :FoodName)");
            echo($_GET['Text']);
            $Req->bindParam(':FoodName', $_GET['TextAddFood'], PDO::PARAM_STR);
            $Req->execute();
        }

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