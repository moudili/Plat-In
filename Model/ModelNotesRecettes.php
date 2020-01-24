<?php

function Recipe()
{
    require('Model/ModelNewPDO.php');
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

function PrintStarts()
{
    if (empty($_GET['Request']))
    {
        require('Model/ModelNewPDO.php');
        $Note=array(array(),array(),array(),array(),array(),array());
        $Req = $Bdd -> prepare("SELECT count(review) FROM reviews");
        $Req -> execute();
        $n=$Req -> fetch();
        $Check=$n[0];

        $Req = $Bdd -> prepare("SELECT S.review, S.ID_recipes, R.name_r,S.ID_reviews FROM reviews S JOIN recipes R");
        $Req -> execute();
        for($j=0;$j<$Check;$j++)
        {
            $n=$Req -> fetch();
            array_push($Note[0], $n[0]);
            array_push($Note[1], $n[1]);
            array_push($Note[2], $n[2]); 
            array_push($Note[3], $n[3]);  
                    
        }    

        return $Note;
    }
}

function Delet()
{
    if ($_GET['RequestSupp']=='ok')
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("DELETE FROM `reviews` WHERE `reviews`.`ID_recipes` = :resultat");
        $Req -> bindParam(':resultat',$Id,PDO::PARAM_INT);
        $Req -> execute(); 
    }
}
?>