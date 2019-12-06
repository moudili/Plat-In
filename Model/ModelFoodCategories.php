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

    function CheckDiet ($CheckMenu,$Diet)
    {
        if(!empty($_GET['Request']))
        {
           if($_GET['Request'] == "Ajouter")
           {
               if(strlen($_GET['Diet']) > 2
               && strlen($_GET['Diet']) < 40
               && preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Diet'])
               && $CheckMenu != "double"
               && $CheckMenu != "void"
               )
               {
                    require("Model/ModelNewPDO.php");
                    $Req = $Bdd -> prepare("SELECT count(ID_diet) FROM diets WHERE name_d LIKE :diet");
                    $Req -> bindParam(':diet',$Diet,PDO::PARAM_STR);
                    $Req -> execute();
                    $n = $Req -> fetch();
                    $CheckForm = $n[0];
                    if($CheckForm == 0)
                    {
                        $Req = $Bdd -> prepare("INSERT INTO `diets` (`ID_diet`, `name_d`) VALUES (NULL, :diet);");
                        $Req -> bindParam(':diet',$Diet,PDO::PARAM_STR);
                        $Req -> execute();
                        
                        $Req = $Bdd -> prepare("SELECT ID_diet FROM diets WHERE name_d LIKE :diet");
                        $Req -> bindParam(':diet',$Diet,PDO::PARAM_STR);
                        $Req -> execute();
                        $n = $Req -> fetch();

                        for($i = 0 ; $i < $_GET['Menu'] ; $i++)
                        {
                            $Req = $Bdd -> prepare("INSERT INTO `can_t_eat` (`ID_can_t_eat`, `ID_diet`, `ID_kind_of_food`) VALUES (NULL,:ID_diet ,:ID_Kind );");
                            $Req -> bindParam(':ID_diet',$n[0],PDO::PARAM_STR);
                            $Req -> bindParam(':ID_Kind',$_GET['Kind'.$i],PDO::PARAM_STR);
                            $Req -> execute();
                        }
                    }
                    return $CheckForm;
               }

           } 
        }                
    }

    function CheckForm ($Cat, $CheckMenu) 
    {
        if($_GET['Request'] == "Ajouter")
        {
            if(!empty($_GET['Cat']))
            {
                if(strlen($_GET['Cat']) > 2
               && strlen($_GET['Cat']) < 40
               && preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['Cat'])
               && $CheckMenu != "double"
               && $CheckMenu != "void"
               )
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

                        for($i = 0 ; $i < $_GET['Menu'] ; $i++)
                        {
                            $Req3 = $Bdd -> prepare("INSERT INTO `food_categories` (`ID_food_categorie`, `ID_food`,`ID_kind_of_food`) VALUES (NULL, :id_food, :id_categorie);");
                            $Req3 -> bindParam(':id_categorie',$IdCategorie,PDO::PARAM_STR);
                            $Req3 -> bindParam(':id_food',$_GET['Kind'.$i],PDO::PARAM_STR);
                            $Req3 -> execute();
                        }

                    }

                    return $CheckForm;
               }
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
        if($_GET['Request'] == "Supprimer cet aliment" AND !empty($_GET['AnswerFood']))
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

    function SearchCategorie()
    {
        if(empty($_GET['Request'])
        || $_GET['Request'] == "Search")
        {
            require("Model/ModelNewPDO.php");
            if(empty($_GET['Request']))
            {
                $Req = $Bdd -> prepare("SELECT KF.ID_kind_of_food,KF.name_k,F.ID_food,F.food_name FROM kinds_of_food KF JOIN food_categories FC JOIN foods F WHERE KF.ID_kind_of_food 
            LIKE FC.ID_kind_of_food AND FC.ID_food LIKE F.ID_food ORDER BY KF.name_k");
            }
            else if($_GET['Request'] == "Search")
            {
                
                $Req = $Bdd -> prepare('SELECT KF.ID_kind_of_food,KF.name_k,F.ID_food,F.food_name FROM kinds_of_food KF JOIN food_categories FC JOIN foods F WHERE KF.ID_kind_of_food 
            LIKE FC.ID_kind_of_food AND FC.ID_food LIKE F.ID_food AND KF.name_k LIKE "%'.$_GET['Cat'].'%" ORDER BY KF.name_k ');
            }
            $Req -> execute();
            $FoodPrint = array(array(),array(),array(),array());
            if($Req->rowCount() > 0)
            {
                while($n = $Req -> fetch())
                {
                    array_push($FoodPrint[0], $n[0]);
                    array_push($FoodPrint[1], $n[1]);
                    array_push($FoodPrint[2], $n[2]);
                    array_push($FoodPrint[3], $n[3]);               
                }
            }
            else
            {
                $FoodPrint = false;
            }
 
           //print_r($FoodPrint);

            return $FoodPrint;
        }
    }

    function CheckAddCat($CheckMenu2)
    {
        if(!empty($_GET['SubRequest']))
        {
            if($_GET['SubRequest'] == "Ajouter"
            && $CheckMenu2 != "double"
            && $CheckMenu2 != "void"
            )
            {
                require("Model/ModelNewPDO.php");
                
                for($i = 0 ; $i < $_GET['Menu'] ; $i++ )
                {
                    $Req = $Bdd -> prepare("SELECT count(ID_food_categorie) FROM food_categories WHERE ID_food LIKE :idfood AND ID_kind_of_food LIKE :idkind");
                    $Req -> bindParam(':idkind',$_GET['id'],PDO::PARAM_INT);
                    $Req -> bindParam(':idfood',$_GET['Kind'.$i],PDO::PARAM_INT);
                    $Req -> execute();
                    $n = $Req -> fetch();
                    $CheckForm = $n[0];
                    if($CheckForm != 0)
                    {
                        break;
                    }
                }

                if($CheckForm == 0)
                {
                    for($i = 0 ; $i < $_GET['Menu'] ; $i++ )
                    {
                        $Req = $Bdd -> prepare("INSERT INTO `food_categories` (`ID_food_categorie`, `ID_kind_of_food`, `ID_food`) VALUES (NULL, :idkind, :idfood);");
                        $Req -> bindParam(':idkind',$_GET['id'],PDO::PARAM_INT);
                        $Req -> bindParam(':idfood',$_GET['Kind'.$i],PDO::PARAM_INT);
                        $Req -> execute();
                    }
                }
                echo $CheckForm;
                return $CheckForm;
            }
        }
    }
?>