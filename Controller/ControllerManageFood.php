<?php

    function LowCase()
    {
        if(isset($_GET['TextAddFood']))
        {
            $org = strtolower($_GET['TextAddFood']);
            return $org;
        }
        elseif(isset($_GET['TextChangeFood']))
        {
            $org = strtolower($_GET['TextChangeFood']);
            return $org;
        }
    }

    $org = LowCase();

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelManageFood.php');

    $Aliments = BDDFood();

    if(isset($org) == TRUE)
    $Repetition=2;

    foreach ($Aliments as $Aliment):
        if($org==$Aliment['food_name'])
        {
            $Repetition=1;
            break;
        }
    endforeach;

    if(isset($_GET['SupprimerAliment']) == TRUE)
    $Repetition=2;
    
    if($Repetition==1)
    {
        $MessageErreur = "Erreur.<br> Répétitions dans la base de donnée avec ".$org."<br><br>";
    }
    elseif($Repetition==2)
    {
        BDDChange($org);
        $MessageErreur = "Changement de la BDD effectué<br><br>";
    }

    elseif($Repetition==3)
    {
        $MessageErreur = "";
    }
    
    $Aliments = BDDFood();
    
    require("View/ViewManageFood.php");

?>