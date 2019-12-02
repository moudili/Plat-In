<?php

    function KindFood()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Ajouter un régime"
                || $_GET['Request'] == "+"
                || $_GET['Request'] == "-"
                || $_GET['Request'] == "Ajouter")
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
    
?>