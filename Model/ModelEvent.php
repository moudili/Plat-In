<?php
 
    function Intolerance()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT U.ID_user,K.name_k
        FROM users U
        JOIN preferences P
        JOIN kinds_of_food K
        WHERE U.ID_user LIKE P.ID_user
        AND P.ID_kind_of_food LIKE K.ID_kind_of_food
        AND P.grade LIKE 0");
        $Req -> execute();
        $Liste=array(array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Liste[0], $n[0]);
            array_push($Liste[1], $n[1]);
        }
        return $Liste;
    }

    function Invitation()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT G.ID_meals,M.name_m,G.ID_guest
        FROM guests G
        JOIN meals M
        WHERE G.ID_user LIKE :id
        AND G.status_g LIKE 'requested'
        AND G.ID_meals LIKE M.ID_meal");
        $Req -> bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $Events=array(array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Events[0], $n[0]);
            array_push($Events[1], $n[1]);
            array_push($Events[2], $n[2]);
        }
        return $Events;
    }

    function AdInvitation()
    {
        if (!empty($_GET['event']) AND $_GET['event']=='Accepter')
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd -> prepare("UPDATE `guests` SET `status_g`='membre' 
            WHERE `guests`.`ID_guest` = :id;");
            $Req -> bindParam(':id',$_GET['ID'],PDO::PARAM_INT);
            $Req -> execute();
        }
        else if (!empty($_GET['event']) AND $_GET['event']=='Refuser')
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd -> prepare("DELETE FROM `guests` 
            WHERE `guests`.`ID_guest` = :resultat");
            $Req -> bindParam(':resultat',$_GET['ID'],PDO::PARAM_INT);
            $Req -> execute();
        }
    }

    function SelectEvent()
    { 
        if (empty($_GET['event']))
        {
            require('Model/ModelNewPDO.php');
            $Req = $Bdd -> prepare("SELECT ID_meal,name_m 
            FROM meals");
            $Req -> execute();
            $Events=array(array(),array());
            while($n = $Req -> fetch())
            {
                array_push($Events[0], $n[0]);
                array_push($Events[1], $n[1]);
            }
            return $Events;
        }
    }
 
    function SelectRecipe()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT name_r,text,ID_recipes
        FROM recipes 
        ORDER BY name_r");
        $Req -> execute();
        $Recipes = array(array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Recipes[0], $n[0]);
            array_push($Recipes[1], $n[1]);
            array_push($Recipes[2], $n[2]);
        }
        return $Recipes;
    }

    function SelectUser()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT ID_user,user,status_u
        FROM users 
        WHERE ID_user NOT LIKE :id
        AND status_u NOT LIKE 'admin'
        ORDER BY user");
        $Req -> bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $Users = array(array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Users[0], $n[0]);
            array_push($Users[1], $n[1]);
            array_push($Users[2], $n[2]);
        }
        return $Users;
    }

    function SelectGuest()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT G.ID_guest,G.ID_user,G.ID_meals,G.status_g,U.user
        FROM guests G
        JOIN users U
        WHERE G.ID_user LIKE U.ID_user
        AND G.ID_user NOT LIKE :id
        ORDER BY G.ID_guest");
        $Req -> bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $Users = array(array(),array(),array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Users[0], $n[0]);
            array_push($Users[1], $n[1]);
            array_push($Users[2], $n[2]);
            array_push($Users[3], $n[3]);
            array_push($Users[4], $n[4]);
        }

        $Req = $Bdd -> prepare("SELECT count(ID_user)
        FROM guests
        WHERE ID_meals LIKE :meal
        AND ID_user NOT LIKE :id");
        $Req -> bindParam(':meal',$_GET['evenement'],PDO::PARAM_STR);
        $Req -> bindParam(':id',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $n = $Req -> fetch();
        array_push($Users, $n[0]);

        return $Users;
    }

    function SelectDish()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT D.ID_dishe, D.ID_meals, D.ID_recipes, D.service_name, R.name_r
        FROM dishes D
        JOIN Recipes R
        WHERE D.ID_recipes LIKE R.ID_recipes
        ORDER BY D.ID_meals");
        $Req -> execute();
        $Users = array(array(),array(),array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Users[0], $n[0]);
            array_push($Users[1], $n[1]);
            array_push($Users[2], $n[2]);
            array_push($Users[3], $n[3]);
            array_push($Users[4], $n[4]);
        }

        $Req = $Bdd -> prepare("SELECT count(ID_dishe)
        FROM dishes
        WHERE ID_meals LIKE :meal");
        $Req -> bindParam(':meal',$_GET['evenement'],PDO::PARAM_INT);
        $Req -> execute();
        $n = $Req -> fetch();
        array_push($Users, $n[0]);

        return $Users;
    }

    function InsertEvent()
    {
        if (!empty($_GET['Request']) 
        AND $_GET['Request'] == "Confirmer" 
        AND !empty($_GET['Name']) 
        AND !empty($_GET['time']) 
        AND !empty($_GET['date'])
        AND !empty($_GET['location'])
        AND !empty($_GET['description'])
        AND $_GET['event']!='Modifier'
        AND strlen($_GET['Name'])<20)
        {
            require('Model/ModelNewPDO.php');
            $Req1 = $Bdd -> prepare("INSERT INTO `meals` (`name_m`, `date_hours`, `date_days`, `location`, `text`) 
            VALUES (:name_e, :hour, :dayss, :ville, :descriptions);");
            $Req1 -> bindParam(':name_e',$_GET['Name'],PDO::PARAM_STR);
            $Req1 -> bindParam(':hour',$_GET['time'],PDO::PARAM_STR);
            $Req1 -> bindParam(':dayss',$_GET['date'],PDO::PARAM_STR);
            $Req1 -> bindParam(':ville',$_GET['location'],PDO::PARAM_STR);
            $Req1 -> bindParam(':descriptions',$_GET['description'],PDO::PARAM_STR);
            $Req1 -> execute();

            $Req2 = $Bdd -> prepare("SELECT MAX(ID_meal)
            FROM meals");
            $Req2 -> execute();
            $n = $Req2 -> fetch();
            $MaxId = $n[0];

            for ($i=0;$i<$_GET['MenuUser'];$i++)
            {
                $Req3 = $Bdd -> prepare("INSERT INTO `guests` (`ID_user`, `ID_meals`, `status_g`) 
                VALUES (:user, :meal, 'requested');");
                $Req3 -> bindParam(':user',$_GET['utilisateur'.$i],PDO::PARAM_INT);
                $Req3 -> bindParam(':meal',$MaxId,PDO::PARAM_INT);
                $Req3 -> execute();
            }

            $Req5 = $Bdd -> prepare("INSERT INTO `guests` (`ID_user`, `ID_meals`, `status_g`) 
            VALUES (:user, :meal, 'admin');");
            $Req5 -> bindParam(':user',$_SESSION['id'],PDO::PARAM_INT);
            $Req5 -> bindParam(':meal',$MaxId,PDO::PARAM_INT);
            $Req5 -> execute();

            for ($i=0;$i<$_GET['MenuRecipe'];$i++)
            {
                $Req4 = $Bdd -> prepare("INSERT INTO `dishes` (`ID_meals`, `ID_recipes`, `service_name`) 
                VALUES (:meal, :recipe, :service_nam);");
                $Req4 -> bindParam(':meal',$MaxId,PDO::PARAM_INT);
                $Req4 -> bindParam(':recipe',$_GET['recette'.$i],PDO::PARAM_INT);
                $Req4 -> bindParam(':service_nam',$_GET['service'.$i],PDO::PARAM_STR);
                $Req4 -> execute();
            }
        }
    }

    function ModifEvent()
    {
        if (!empty($_GET['Request']) 
        AND $_GET['Request'] == "Confirmer" 
        AND !empty($_GET['Name']) 
        AND !empty($_GET['time']) 
        AND !empty($_GET['date'])
        AND !empty($_GET['location'])
        AND !empty($_GET['description'])
        AND $_GET['event']=='Modifier'
        AND strlen($_GET['Name'])<20)
        {
            require('Model/ModelNewPDO.php');
            $Req1 = $Bdd -> prepare("UPDATE `meals` SET `name_m`=:name_e, `date_hours`=:hour, `date_days`=:dayss, `location`=:ville, `text`=:descriptions
            WHERE `meals`.`ID_meal` = :id;");
            $Req1 -> bindParam(':name_e',$_GET['Name'],PDO::PARAM_STR);
            $Req1 -> bindParam(':hour',$_GET['time'],PDO::PARAM_STR);
            $Req1 -> bindParam(':dayss',$_GET['date'],PDO::PARAM_STR);
            $Req1 -> bindParam(':ville',$_GET['location'],PDO::PARAM_STR);
            $Req1 -> bindParam(':descriptions',$_GET['description'],PDO::PARAM_STR);
            $Req1 -> bindParam(':id',$_GET['evenement'],PDO::PARAM_INT);
            $Req1 -> execute();

            $Req6 = $Bdd -> prepare("DELETE FROM `dishes` WHERE `dishes`.`ID_meals` = :resultat");
            $Req6 -> bindParam(':resultat',$_GET['evenement'],PDO::PARAM_INT);
            $Req6 -> execute();

            $Req7 = $Bdd -> prepare("DELETE FROM `guests` WHERE `guests`.`ID_meals` = :resultat");
            $Req7 -> bindParam(':resultat',$_GET['evenement'],PDO::PARAM_INT);
            $Req7 -> execute();

            $MaxId=$_GET['evenement'];

            for ($i=0;$i<$_GET['MenuUser'];$i++)
            {
                $Req3 = $Bdd -> prepare("INSERT INTO `guests` (`ID_user`, `ID_meals`, `status_g`) 
                VALUES (:user, :meal, 'requested');");
                $Req3 -> bindParam(':user',$_GET['utilisateur'.$i],PDO::PARAM_INT);
                $Req3 -> bindParam(':meal',$MaxId,PDO::PARAM_INT);
                $Req3 -> execute();
            }

            $Req5 = $Bdd -> prepare("INSERT INTO `guests` (`ID_user`, `ID_meals`, `status_g`) 
            VALUES (:user, :meal, 'admin');");
            $Req5 -> bindParam(':user',$_SESSION['id'],PDO::PARAM_INT);
            $Req5 -> bindParam(':meal',$MaxId,PDO::PARAM_INT);
            $Req5 -> execute();

            for ($i=0;$i<$_GET['MenuRecipe'];$i++)
            {
                $Req4 = $Bdd -> prepare("INSERT INTO `dishes` (`ID_meals`, `ID_recipes`, `service_name`) 
                VALUES (:meal, :recipe, :service_nam);");
                $Req4 -> bindParam(':meal',$MaxId,PDO::PARAM_INT);
                $Req4 -> bindParam(':recipe',$_GET['recette'.$i],PDO::PARAM_INT);
                $Req4 -> bindParam(':service_nam',$_GET['service'.$i],PDO::PARAM_STR);
                $Req4 -> execute();
            }
        }
    }

    function SelectSupp()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT ID_user,ID_meals,status_g
        FROM guests");
        $Users = array(array(),array(),array());
        $Req -> execute();
        while($n = $Req -> fetch())
        {
            array_push($Users[0], $n[0]);
            array_push($Users[1], $n[1]);
            array_push($Users[2], $n[2]);
        }
        return $Users;
    }

    function PrintEvent()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT M.ID_meal,M.name_m,M.date_hours,M.date_days,M.location,
        M.text,D.ID_recipes,D.service_name,R.name_r
        FROM meals M
        JOIN dishes D
        JOIN recipes R
        WHERE M.ID_meal LIKE D.ID_meals
        AND D.ID_recipes LIKE R.ID_recipes
        ORDER BY M.ID_meal AND D.ID_recipes"); 
        $Req -> execute();
        $Events=array(array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Events[0], $n[0]);
            array_push($Events[1], $n[1]);
            array_push($Events[2], $n[2]);
            array_push($Events[3], $n[3]);
            array_push($Events[4], $n[4]);
            array_push($Events[5], $n[5]);
            array_push($Events[6], $n[6]);
            array_push($Events[7], $n[7]);
            array_push($Events[8], $n[8]);
        }
        return $Events;
    }

    function PrintUser()
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT G.ID_meals, G.ID_user, U.user
        FROM guests G
        JOIN users U
        WHERE G.ID_user LIKE U.ID_user");
        $Req -> execute();
        $Events=array(array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Events[0], $n[0]);
            array_push($Events[1], $n[1]);
            array_push($Events[2], $n[2]);
        }
        return $Events;
    }

    function SuppEvent()
    {
        if (!empty($_GET['Supp']) AND $_GET['Supp']=='Oui')
        {
            require('Model/ModelNewPDO.php');
            $Id=$_GET['evenement'];
            $Req = $Bdd -> prepare("DELETE FROM `meals` WHERE `meals`.`ID_meal` = :resultat");
            $Req -> bindParam(':resultat',$Id,PDO::PARAM_INT);
            $Req -> execute();
        }
    }

    function SelectModifEvent()
    {
        if (!empty($_GET['event']) AND $_GET['event']=='Modifier' AND empty($_GET['modif']))
        {
            require('Model/ModelNewPDO.php');
            $Id=$_GET['evenement'];
            $Req = $Bdd -> prepare("SELECT M.ID_meal,M.name_m,M.date_hours,M.date_days,M.location,
            M.text
            FROM meals M
            WHERE M.ID_meal LIKE :id");
            $Req -> bindParam(':id',$Id,PDO::PARAM_INT);
            $Req -> execute();
            $Events=array();
            $n = $Req -> fetch();

            array_push($Events, $n[0]);
            array_push($Events, $n[1]);
            array_push($Events, $n[2]);
            array_push($Events, $n[3]);
            array_push($Events, $n[4]);
            array_push($Events, $n[5]);
            
            return $Events;
        }
    }
?>