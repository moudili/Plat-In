<?php

    function KindFood()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Ajouter un régime"
                || $_GET['Request'] == "+"
                || $_GET['Request'] == "-"
                || $_GET['Request'] == "Ajouter"
                || $_GET['Request'] == "Ajouter des catégories")
            {
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT ID_kind_of_food,name_k FROM kinds_of_food ORDER BY name_k");
                $Req -> execute();
                $Kind = array(array(),array());
                
                while($n = $Req -> fetch())
                {
                    array_push($Kind[0], $n[0]);
                    array_push($Kind[1], $n[1]);               
                }     
                return $Kind;
            }
        }
    }

    function CheckDiet ($CheckMenu,$PrintDiet)
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
                    $Req -> bindParam(':diet',$PrintDiet,PDO::PARAM_STR);
                    $Req -> execute();
                    $n = $Req -> fetch();
                    $CheckForm = $n[0];
                    if($CheckForm == 0)
                    {
                        $Req = $Bdd -> prepare("INSERT INTO `diets` (`ID_diet`, `name_d`) VALUES (NULL, :diet);");
                        $Req -> bindParam(':diet',$PrintDiet,PDO::PARAM_STR);
                        $Req -> execute();
                        
                        $Req = $Bdd -> prepare("SELECT ID_diet FROM diets WHERE name_d LIKE :diet");
                        $Req -> bindParam(':diet',$PrintDiet,PDO::PARAM_STR);
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

    function PrintDiet ()
    {
        if(empty($_GET['Request'])
        || $_GET['Request'] == "Search")
        {
            require("Model/ModelNewPDO.php");
            if(empty($_GET['Request']))
            {
                $Req = $Bdd -> prepare("SELECT D.ID_diet,D.name_d,KF.ID_kind_of_food,KF.name_k 
                FROM kinds_of_food KF 
                JOIN can_t_eat CE 
                JOIN diets D 
                WHERE KF.ID_kind_of_food LIKE CE.ID_kind_of_food 
                AND CE.ID_diet LIKE D.ID_diet 
                ORDER BY D.name_d ;");
            }
            else if($_GET['Request'] == "Search")
            {
                $Req = $Bdd -> prepare('SELECT D.ID_diet,D.name_d,KF.ID_kind_of_food,KF.name_k 
                FROM kinds_of_food KF 
                JOIN can_t_eat CE 
                JOIN diets D 
                WHERE KF.ID_kind_of_food LIKE CE.ID_kind_of_food 
                AND CE.ID_diet LIKE D.ID_diet
                AND D.name_d LIKE "%'.$_GET['Search'].'%" 
                ORDER BY D.name_d ;');
            }
            $Req -> execute();
            $PrintDiet = array(array(),array(),array(),array());
            if($Req->rowCount() > 0)
            {
                while($n = $Req -> fetch())
                {
                    array_push($PrintDiet[0], $n[0]);
                    array_push($PrintDiet[1], $n[1]);
                    array_push($PrintDiet[2], $n[2]);
                    array_push($PrintDiet[3], $n[3]);               
                }
            }
            else
            {
                $PrintDiet = false;
            }
 
            //print_r($PrintDiet);

            return $PrintDiet;
        }
    }

    function DeletCat()
    {
        if(empty($_GET['Request']))
        {
            if(!empty($_GET['SubRequest']))
            {
                if($_GET['SubRequest'] == "Supprimer")
                {
                    require("Model/ModelNewPDO.php");
                    $Req = $Bdd -> prepare("DELETE FROM `can_t_eat` WHERE `can_t_eat`.`ID_diet` = :iddiet AND `can_t_eat`.`ID_kind_of_food` = :idcat ");
                    $Req -> bindParam(':iddiet',$_GET['iddiet'],PDO::PARAM_INT);
                    $Req -> bindParam(':idcat',$_GET['idcat'],PDO::PARAM_INT);
                    $Req -> execute();                    
                }
            }
        }
    }

    function DeletDiet()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Supprimer ce régime")
            {
                if(!empty($_GET['answer']))
                {
                    require("Model/ModelNewPDO.php");
                    $Req = $Bdd -> prepare("DELETE FROM `diets` WHERE `diets`.`ID_diet` = :iddiet ");
                    $Req -> bindParam(':iddiet',$_GET['iddiet'],PDO::PARAM_INT);
                    $Req -> execute();
                }
            }  
        }
    }
    
    function EditDiet ()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Modifier")
            {
                if(strlen($_GET['newdiet']) > 2
                && strlen($_GET['newdiet']) < 40
                && preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['newdiet'])
                )
                {
                    require("Model/ModelNewPDO.php");
                    $Req = $Bdd -> prepare("SELECT count(ID_diet) FROM diets WHERE name_d LIKE :diet");
                    $Req -> bindParam(':diet',$_GET['newdiet'],PDO::PARAM_INT);
                    $Req -> execute();
                    $n = $Req -> fetch();
                    $CheckForm2 = $n[0];
                    
                    if($CheckForm2 == 0)
                    {
                        $Req = $Bdd -> prepare("UPDATE `diets` SET `name_d` = :diet WHERE `diets`.`ID_diet` = :iddiet ;");
                        $Req -> bindParam(':diet',$_GET['newdiet'],PDO::PARAM_INT);
                        $Req -> bindParam(':iddiet',$_GET['iddiet'],PDO::PARAM_INT);
                        $Req -> execute();
                    }
                    return $CheckForm2;
                }
            }
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
                    $Req = $Bdd -> prepare("SELECT count(ID_can_t_eat) FROM can_t_eat WHERE ID_diet LIKE :iddiet AND ID_kind_of_food LIKE :idfood");
                    $Req -> bindParam('iddiet',$_GET['iddiet'],PDO::PARAM_INT);
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
                        $Req = $Bdd -> prepare("INSERT INTO `can_t_eat` (`ID_can_t_eat`, `ID_diet`, `ID_kind_of_food`) VALUES (NULL, :iddiet, :idfood);");
                        $Req -> bindParam('iddiet',$_GET['iddiet'],PDO::PARAM_STR);
                        $Req -> bindParam(':idfood',$_GET['Kind'.$i],PDO::PARAM_STR);
                        $Req -> execute();
                    }
                }
                echo $CheckForm;
                return $CheckForm;
            }
        }
    }
?>