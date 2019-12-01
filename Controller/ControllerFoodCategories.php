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
            
      
            //print_r($Liste);
            //echo($Liste[0][0]);
            if ($i > 0)
            {
                for ($j = 0 ; $j < count($ListeFini[1]) ; $j++)
                {
                    if ($Liste[1][$i] == $ListeFini[1][$j])
                    {
                        $Test = true;
                        break;
                    } 
                    else 
                    {
                        $Test = false;
                    }
                }
            }
            else 
            {
                $Test = false;
            }


            if ($Test == false AND $i==0)
            {
                array_push($ListeFini[2], array());
                array_push($ListeFini[3], array());
                array_push($ListeFini[0], $Liste[0][$i]);
                array_push($ListeFini[1], $Liste[1][$i]);
                array_push($ListeFini[2][$i], $Liste[2][$i]);
                array_push($ListeFini[3][$i], $Liste[3][$i]);
            } 
            else if ($Test == false)
            {
                array_push($ListeFini[2], array());
                array_push($ListeFini[3], array());
                array_push($ListeFini[0], $Liste[0][$i]);
                array_push($ListeFini[1], $Liste[1][$i]);
                array_push($ListeFini[2][$i], $Liste[2][$i]);
                array_push($ListeFini[3][$i], $Liste[3][$i]);
            } 
            else
            {
                array_push($ListeFini[2][$i-1], $Liste[2][$i]);
                array_push($ListeFini[3][$i-1], $Liste[3][$i]);      
            }
        }
        return $ListeFini;
    }

    require('Controller/ControllerStable.php');
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
