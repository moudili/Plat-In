<?php
    
    function CheckCategorie()
    {
        if($_GET['Request'] == "Ajouter"
        || $_GET['Request'] == "Modifier cette categorie"
        || $_GET['Request'] == "Search")
        {
            if(!empty($_GET['Cat']))
            {
                $Cat = $_GET['Cat'];
                $Cat = strtolower($Cat);
                return $Cat;

            }
        }
    }

    function CheckID()
    {
        if (!empty($_GET['Food']))
        {
            $IdFood=CheckIDFood($_GET['Food']);
            return $IdFood;
        }
    };

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelFoodCategories.php');
    $Categories = Categorie();
    $Foods = Food();
    print_r($Foods);
    $ID=CheckID();
    echo("C'est l'ID ".$ID);
    if(!empty($_GET['Request']))
    {

        $Cat = CheckCategorie();
        
        $CheckFormAdd = CheckForm ($Cat, $ID);
        
        DeletCategorie();
        
        $CheckFormUpdate = ModifCategorie($Cat);

        $Categories = SearchCategorie($Cat);
        
    }
    require("View/ViewFoodCategories.php");
?>
