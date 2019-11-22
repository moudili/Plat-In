<?php

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