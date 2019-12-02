<?php

    function Categorie()
    {
        if(empty($_GET['Request']))
        {
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("SELECT ID_kind_of_food, name_k FROM kinds_of_food ORDER BY name_k");
            $Req -> execute();
            $Categories = array(array(),array());
            while($n = $Req -> fetch())
            {
                array_push($Categories[0], $n[0]);
                array_push($Categories[1], $n[1]);               
            }
            
            return $Categories;
        }
    }

    function Food()
    {
        require("Model/ModelNewPDO.php");
        if(!empty($_GET['Request']))
        {
            $Req = $Bdd -> prepare("SELECT ID_food, food_name FROM foods");
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

    function CheckFood()
    {
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("SELECT KF.ID_kind_of_food,KF.name_k,F.ID_food,F.food_name FROM kinds_of_food KF JOIN food_categories FC JOIN foods F WHERE KF.ID_kind_of_food 
            LIKE FC.ID_kind_of_food AND FC.ID_food LIKE F.ID_food ORDER BY KF.name_k");
        $Req->execute();
        $Liste=array(array(),array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Liste[0], $n[0]);
            array_push($Liste[1], $n[1]);               
            array_push($Liste[2], $n[2]);
            array_push($Liste[3], $n[3]);  
        }
        
        return $Liste;
    }

    function CheckForm ($Cat, $IdFood) 
    {
        if($_GET['Request'] == "Ajouter")
        {
            if(!empty($_GET['Cat']))
            {
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT count(ID_kind_of_food) FROM kinds_of_food WHERE name_k LIKE :categorie");
                $Req -> bindParam(':categorie',$Cat,PDO::PARAM_STR);
                $Req -> execute();
                $n = $Req -> fetch();
                $CheckForm = $n[0];

                if($CheckForm == 0)
                {
                    $Req1 = $Bdd -> prepare("INSERT INTO `kinds_of_food` (`ID_kind_of_food`, `name_k`) VALUES (NULL, :categorie);");
                    $Req1 -> bindParam(':categorie',$Cat,PDO::PARAM_STR);
                    $Req1 -> execute();     
                    
                    $Req2 = $Bdd -> prepare("SELECT MAX(ID_kind_of_food) FROM kinds_of_food");
                    $Req2 -> execute();
                    $n=$Req2->fetch();
                    $IdCategorie=$n[0];

                    $Req3 = $Bdd -> prepare("INSERT INTO `food_categories` (`ID_food_categories`, `ID_food`,`ID_kind_of_food`) VALUES (NULL, :id_food, :id_categorie);");
                    $Req3 -> bindParam(':id_categorie',$IdCategorie,PDO::PARAM_STR);
                    $Req3 -> bindParam(':id_food',$IdFood,PDO::PARAM_STR);
                    $Req3 -> execute();

                }

                return $CheckForm;

            }
        }
    }

    function CheckIDFood($Foood)
    {
        if($_GET['Request'] == "Ajouter")
        {
            if(!empty($_GET['Cat']))
            {
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT ID_food FROM foods WHERE food_name LIKE :FoodName");
                $Req -> bindParam(':FoodName',$Foood,PDO::PARAM_STR);
                $Req -> execute();
                $n=$Req->fetch();
                $Resultat=$n[0];
                return $Resultat;
            }
        }
    }


    function DeletCategorie() 
    {
        if($_GET['Request'] == "Supprimer")
        {
            if(!empty($_GET['Answer']))
            {
                $Id = $_GET['id'];
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("DELETE FROM `kinds_of_food` WHERE `kinds_of_food`.`ID_kind_of_food` = :id");
                $Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                $Req -> execute();    
                
                $Req2 = $Bdd -> prepare("DELETE FROM `food_categories` WHERE `food_categories`.`ID_kind_of_food` = :id");
                $Req2 -> bindParam(':id',$Id,PDO::PARAM_STR);
                $Req2 -> execute(); 

            }
        }
    }

    function DeletFood()
    {
        if($_GET['Request'] == "Supprimer cet aliment")
        {        
            $Food = $_GET['aliment'];
            require("Model/ModelNewPDO.php"); 
            $Req = $Bdd -> prepare("SELECT ID_food FROM foods WHERE food_name LIKE :FoodName");
            $Req -> bindParam(':FoodName',$Food,PDO::PARAM_STR);
            $Req -> execute();
            $n=$Req->fetch();
            $Resultat=$n[0];
            
            $Id = $_GET['id'];
            $Req2 = $Bdd -> prepare("DELETE FROM `food_categories` WHERE `food_categories`.`ID_food` = :resultat AND `food_categories`.`ID_kind_of_food` = :id");
            $Req2 -> bindParam(':resultat',$Resultat,PDO::PARAM_STR);
            $Req2 -> bindParam(':id',$Id,PDO::PARAM_STR);
            $Req2 -> execute(); 

        }
    }

    function ModifCategorie($Cat)
    {
        if($_GET['Request'] == "Modifier cette categorie")
        {
            if(!empty($_GET['Cat']))
            {
                $Id = $_GET['id'];
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT count(ID_kind_of_food) FROM kinds_of_food WHERE name_k LIKE :categorie");
                $Req -> bindParam(':categorie',$Cat,PDO::PARAM_STR);
                //$Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                $Req -> execute();
                $n = $Req -> fetch();
                $CheckForm = $n[0];

                if($CheckForm == 0)
                {
                    $Req = $Bdd -> prepare("UPDATE `kinds_of_food` SET `name_k` = :categorie WHERE `kinds_of_food`.`ID_kind_of_food` = :id;");
                    $Req -> bindParam(':categorie',$Cat,PDO::PARAM_STR);
                    $Req -> bindParam(':id',$Id,PDO::PARAM_STR);
                    $Req -> execute();                    

                }

                return $CheckForm;
            }
        }
    }

    function SearchCategorie($Cat)
    {
        if($_GET['Request'] == "Search")
        {

            require("Model/ModelNewPDO.php");
            if(empty($_GET['Cat']))
            {
                $Req = $Bdd -> prepare("SELECT ID_kind_of_food,name_k FROM kinds_of_food ORDER BY name_k");
                $Req -> execute();
                $Categories = array(array(),array());
                while($n = $Req -> fetch())
                {
                    array_push($Categories[0], $n[0]);
                    array_push($Categories[1], $n[1]);               
                }
            }
            else
            {
                $Req = $Bdd -> prepare('SELECT ID_kind_of_food,name_k FROM kinds_of_food WHERE name_k LIKE "%'.$Cat.'%" ');
                $Req -> execute();
                $Categories = array(array(),array());
                if($Req->rowCount() > 0)
                {
                    while($n = $Req -> fetch())
                    {
                        array_push($Categories[0], $n[0]);
                        array_push($Categories[1], $n[1]);               
                    }
                }
                else
                {
                    $Categories = false;
                }
            }
            return $Categories;
        }
    }

?>