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

    function PrintListe($Liste)
    {
        //print_r($Liste);
        $ListeFini=array(array(),array(),array(),array());
        //echo(count($Liste[2]));
        for ($i = 0 ; $i < count($Liste[0]) ; $i++)
        {
            //echo($Liste[0][$i]."  ");
            
    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelFoodCategories.php');
    $Categories = Categorie();
    $FoodPrint=CheckFood();
    //print_r($FoodPrint);
    $Liste = PrintListe($FoodPrint);
    //print_r($Liste);
    $Foods = Food();
    $ID=CheckID();
    if(!empty($_GET['Request']))
    {

        $Cat = CheckCategorie();
        
        $CheckFormAdd = CheckForm ($Cat, $ID);
        
        DeletCategorie();
        DeletFood();
        
        $CheckFormUpdate = ModifCategorie($Cat);

        $Categories = SearchCategorie($Cat);
        
    }
    require("View/ViewFoodCategories.php");
?>
