<?php

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

    function InsertRecipe()
    {
        if (!empty($_GET['Request']) AND $_GET['Request']=='Valider')
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

            $Req = $Bdd -> prepare("SELECT count(name_r) FROM recipes WHERE name_r LIKE :origin");
            $Req -> bindParam(':origin',$Name,PDO::PARAM_STR);
            $Req -> execute();
            $n = $Req -> fetch();
            $CheckForm = $n[0];
            if($CheckForm == 0)
            {
                $Req = $Bdd -> prepare("INSERT INTO `recipes` (`ID_recipes`, `name_r`, `text`, `picture`, `date_r`, `cooking_time`, 
                `ID_origin`, `ID_user`) VALUES (NULL, :name_r, :texte, NULL,  NOW(), :cooking_time, :origin, :user);");
                $Req -> bindParam(':name_r',$Name,PDO::PARAM_STR);
                $Req -> bindParam(':texte',$Text,PDO::PARAM_STR);
                $Req -> bindParam(':cooking_time',$Time,PDO::PARAM_INT);
                $Req -> bindParam(':origin',$Origin,PDO::PARAM_INT);
                $Req -> bindParam(':user',$User1,PDO::PARAM_INT);
                $Req -> execute();
            }

            return $CheckForm;
            
        }
    }

?>