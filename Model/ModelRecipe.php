<?php

    function Recipe()
    {
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT R.name_r,R.text,R.date_r,R.cooking_time,R.ID_user,U.user,R.ID_recipes,R.ID_origin FROM recipes R JOIN users U WHERE R.ID_user LIKE U.ID_user ORDER BY R.name_r");
        $Req -> execute();
        $Recipes = array(array(),array(),array(),array(),array(),array(),array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Recipes[0], $n[0]);
            array_push($Recipes[1], $n[1]); 
            array_push($Recipes[2], $n[2]);
            array_push($Recipes[3], $n[3]);
            array_push($Recipes[4], $n[4]);
            array_push($Recipes[5], $n[5]);
            array_push($Recipes[6], $n[6]);
            array_push($Recipes[7], $n[7]);
        }
        return $Recipes;
    }

    function Origin()
    {
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT ID_origin, origin_name FROM origins ORDER BY origin_name");
        $Req -> execute();
        $Origins = array(array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Origins[0], $n[0]);
            array_push($Origins[1], $n[1]);               
        }
        return $Origins;
    }

    function Food()
    {
        require('Model\ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT ID_food, food_name FROM foods ORDER BY food_name");
        $Req -> execute();
        $Foods = array(array(),array());
        while($n = $Req -> fetch())
        {
            array_push($Foods[0], $n[0]);
            array_push($Foods[1], $n[1]);               
        }
        return $Foods;
    }

    function ModifFood()
    {
        if (!empty($_GET['Request']) AND $_GET['Request']=='Modifier')
        {
            require('Model\ModelNewPDO.php');
            $Req = $Bdd -> prepare("SELECT I.ID_recipes,I.ID_food, F.food_name FROM ingredients I JOIN foods F WHERE I.ID_food LIKE F.ID_food AND I.ID_recipes LIKE :id ORDER BY food_name");
            $Req -> bindParam(':id',$_GET['id'],PDO::PARAM_INT);
            $Req -> execute();
            $NewFoods = array(array(),array(),array());
            while($n = $Req -> fetch())
            {
                array_push($NewFoods[0], $n[0]);
                array_push($NewFoods[1], $n[1]);
                array_push($NewFoods[2], $n[2]);               
            }
            return $NewFoods;
        }
    }

    function InsertRecipe($Menu)
    {
        if (!empty($_GET['Request']) AND $_GET['Request']=='Valider')
        {
            if (!empty($_GET['name']) 
            AND !empty($_GET['food0']) 
            AND !empty($_GET['time'])
            AND !empty($_GET['origine'])
            AND !empty($_GET['text']))
            {
                $Name=$_GET['name'];
                $Text=$_GET['text'];
                $Time=$_GET['time'];
                $Origin=$_GET['origine'];
                $User=$_SESSION['User'];
                require('Model\ModelNewPDO.php');
                $Req = $Bdd -> prepare("SELECT ID_user FROM users WHERE user LIKE :user");
                $Req -> bindParam(':user',$User,PDO::PARAM_STR);
                $Req -> execute();
                $n=$Req -> fetch();
                $User1=$n[0];

                $Req = $Bdd -> prepare("INSERT INTO `recipes` (`ID_recipes`, `name_r`, `text`, `picture`, `date_r`, `cooking_time`, 
                `ID_origin`, `ID_user`) VALUES (NULL, :name_r, :texte, NULL,  NOW(), :cooking_time, :origin, :user);");
                $Req -> bindParam(':name_r',$Name,PDO::PARAM_STR);
                $Req -> bindParam(':texte',$Text,PDO::PARAM_STR);
                $Req -> bindParam(':cooking_time',$Time,PDO::PARAM_STR);
                $Req -> bindParam(':origin',$Origin,PDO::PARAM_INT);
                $Req -> bindParam(':user',$User1,PDO::PARAM_INT);
                $Req -> execute();
                $Req = $Bdd -> prepare("SELECT MAX(ID_recipes) FROM recipes");
                $Req -> execute();
                $n=$Req -> fetch();
                $Max=$n[0];
                for ($i=0;$i<$Menu;$i++)
                {
                    $Req = $Bdd -> prepare("INSERT INTO `ingredients` (`ID_recipes`, `ID_food`) 
                    VALUES (:recipe, :name_f)");
                    $Req -> bindParam(':recipe',$Max,PDO::PARAM_INT);
                    $Req -> bindParam(':name_f',$_GET['food'.$i],PDO::PARAM_INT);
                    $Req -> execute();
                }

            }
            
        }
    }

    function ModifRecipes($Menu2)
    {
        if (!empty($_GET['RequestModif']) AND $_GET['RequestModif']=='Confirmation')
        {
            if (!empty($_GET['name']) 
            AND !empty($_GET['food0']) 
            AND !empty($_GET['time'])
            AND !empty($_GET['origine'])
            AND !empty($_GET['text']))
            {
                $Name=$_GET['name'];
                $Text=$_GET['text'];
                $Time=$_GET['time'];
                $Origin=$_GET['origine'];
                $Id=$_GET['id'];

                require('Model\ModelNewPDO.php');

                $Req = $Bdd -> prepare("UPDATE `recipes` SET `name_r` = :name_r, `text` = :texte, `date_r`=NOW(), `cooking_time`=:time_r WHERE `recipes`.`ID_recipes` = :id;");
                $Req -> bindParam(':name_r',$Name,PDO::PARAM_STR);
                $Req -> bindParam(':texte',$Text,PDO::PARAM_STR);
                $Req -> bindParam(':time_r',$Time,PDO::PARAM_STR);
                $Req -> bindParam(':id',$Id,PDO::PARAM_INT);
                $Req -> execute(); 

                $Req2 = $Bdd -> prepare("DELETE FROM `ingredients` WHERE `ingredients`.`ID_recipes` = :resultat");
                $Req2 -> bindParam(':resultat',$Id,PDO::PARAM_INT);
                $Req2 -> execute();

                for ($i=0;$i<$Menu2;$i++)
                {

                    $Req = $Bdd -> prepare("INSERT INTO `ingredients` (`ID_recipes`, `ID_food`) 
                    VALUES (:recipe, :name_f)");
                    $Req -> bindParam(':recipe',$Id,PDO::PARAM_INT);
                    $Req -> bindParam(':name_f',$_GET['food'.$i],PDO::PARAM_INT);
                    $Req -> execute();
                }
            }
            
        }
    }

    function SuppRecipe()
    {
        if (!empty($_GET['RequestSupp']) AND $_GET['RequestSupp']=='Oui')
        {
            $Id = $_GET['id'];
            require('Model\ModelNewPDO.php');
            $Req = $Bdd -> prepare("DELETE FROM `recipes` WHERE `recipes`.`ID_recipes` = :resultat");
            $Req -> bindParam(':resultat',$Id,PDO::PARAM_INT);
            $Req -> execute();
        }
    }

?>