<?php

    function PrintDiet()
    {
        require('../Model/ModelNewPDO.php');
        $Req1 = $Bdd -> prepare("SELECT * FROM diets ORDER BY name_d");
        $Req1 -> execute();
        $PrintDiet = array(array(),array());
        
        while($n = $Req1 -> fetch())
        {
            array_push($PrintDiet[0], $n[0]);
            array_push($PrintDiet[1], $n[1]);
        }

        return $PrintDiet;

    }

    function PrintFood()
    {
        require('../Model/ModelNewPDO.php');
        $Req1 = $Bdd -> prepare("SELECT * FROM kinds_of_food ORDER BY name_k");
        $Req1 -> execute();
        $PrintFood = array(array(),array());
        
        while($n = $Req1 -> fetch())
        {
            array_push($PrintFood[0], $n[0]);
            array_push($PrintFood[1], $n[1]);
        }

        return $PrintFood;        
    }

    function DataCheck3 ($Check1,$Check2)
    {
        if(!empty($_GET['Request']) && $_GET['Request'] == 'Valider' && $Check1 == "true" && $Check2 == "true")
        {
            require('../Model/ModelNewPDO.php');
            for($i = 0 ; $i < $_GET['Menu'] ; $i++)
            {
                $Req1 = $Bdd -> prepare("SELECT KF.ID_kind_of_food 
                FROM kinds_of_food KF
                JOIN can_t_eat CE
                JOIN diets D
                WHERE KF.ID_kind_of_food LIKE CE.ID_kind_of_food
                AND CE.ID_diet LIKE D.ID_diet
                AND D.ID_diet LIKE :iddiet");
                $Req1 -> bindParam(':iddiet',$_GET['Diet'.$i],PDO::PARAM_INT);
                $Req1 -> execute();
                $CatDiet = array();
                while($n = $Req1 -> fetch())
                {
                    array_push($CatDiet, $n[0]);
                }
                return $CatDiet;
            }            
        }        
    }

    function Preferences($Check1,$Check2,$Check3)
    {
        if(!empty($_GET['Request']) && $_GET['Request'] == 'Valider' && $Check1 == "true" && $Check2 == "true" && $Check3 == "true")
        {
            require('../Model/ModelNewPDO.php');

            $Req = $Bdd -> prepare("SELECT COUNT(ID_preference) FROM preferences WHERE ID_user LIKE :IdUser");
            $Req -> bindParam(':IdUser',$_SESSION['id'],PDO::PARAM_INT);
            $Req -> execute();
            $n = $Req -> fetch();
            $Check = $n[0];

            if($Check > 0)
            {   
                $Req = $Bdd -> prepare("DELETE FROM `preferences` WHERE `preferences`.`ID_user` = :IdUser");
                $Req -> bindParam(':IdUser',$_SESSION['id'],PDO::PARAM_INT);
                $Req -> execute();                
            }

            for($i = 0 ; $i < $_GET['Menu'] ; $i++)
            {
                $Req1 = $Bdd -> prepare("SELECT KF.ID_kind_of_food 
                FROM kinds_of_food KF
                JOIN can_t_eat CE
                JOIN diets D
                WHERE KF.ID_kind_of_food LIKE CE.ID_kind_of_food
                AND CE.ID_diet LIKE D.ID_diet
                AND D.ID_diet LIKE :iddiet");
                $Req1 -> bindParam(':iddiet',$_GET['Diet'.$i],PDO::PARAM_INT);
                $Req1 -> execute();
                
                while($n = $Req1 -> fetch())
                {
                    $Req2 = $Bdd -> prepare("INSERT INTO `preferences` (`ID_preference`, `ID_kind_of_food`, `ID_user`, `grade`) 
                    VALUES (NULL, :IdKf, :IdUser, '0');");
                    $Req2 -> bindParam(':IdKf',$n[0],PDO::PARAM_INT);
                    $Req2 -> bindParam(':IdUser',$_SESSION['id'],PDO::PARAM_INT);
                    $Req2 -> execute();
                }
            }

            for($i = 0 ; $i < 3 ; $i++)
            {
                $Req = $Bdd -> prepare("INSERT INTO `preferences` (`ID_preference`, `ID_kind_of_food`, `ID_user`, `grade`) 
                VALUES (NULL, :IdKf, :IdUser, '10');");
                $Req -> bindParam(':IdKf',$_GET['Food'.$i],PDO::PARAM_INT);
                $Req -> bindParam(':IdUser',$_SESSION['id'],PDO::PARAM_INT);
                $Req -> execute();
            }

            $Req1 = $Bdd -> prepare("SELECT P.ID_kind_of_food 
            FROM preferences P
            JOIN users U
            WHERE U.ID_user LIKE :IdUser
            AND  P.ID_user LIKE U.ID_user
            AND (P.grade LIKE 0 
            OR P.grade LIKE 10)
            ORDER BY P.ID_kind_of_food");
            $Req1 -> bindParam(':IdUser',$_SESSION['id'],PDO::PARAM_INT);
            $Req1 -> execute();
            $Pref = array();
            while($n = $Req1 -> fetch())
            {
                array_push($Pref, $n[0]);
            }
            //print_r($Pref);
            //echo $_SESSION['id'];

            $Req2 = $Bdd -> prepare("SELECT ID_kind_of_food FROM kinds_of_food ORDER BY ID_kind_of_food");
            $Req2 -> execute();
            $Fc = array();
            while($n = $Req2 -> fetch())
            {
                array_push($Fc, $n[0]);
            }
            //print_r($Fc);
            //echo $Fc[count($Fc)-1];

            for($i = 0 ; $i < count($Fc) ; $i++)
            {
                
                if(!in_array($Fc[$i],$Pref))
                {
                    $Req3 = $Bdd -> prepare("INSERT INTO `preferences` (`ID_preference`, `ID_kind_of_food`, `ID_user`, `grade`) 
                    VALUES (NULL, :IdKf, :IdUser, '5');");
                    $Req3 -> bindParam(':IdKf',$Fc[$i],PDO::PARAM_INT);
                    $Req3 -> bindParam(':IdUser',$_SESSION['id'],PDO::PARAM_INT);
                    $Req3 -> execute();
                }
            }

        }
    }
?>