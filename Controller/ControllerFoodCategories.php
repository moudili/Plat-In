<?php

    function CheckSubMenu()
    {
        if(!empty($_GET['SubRequest']))
        {
            if($_GET['SubRequest'] == "Ajouter")
            {
                $CheckMenu = "true";
                for($i = 0 ; $i < $_GET['Menu'] ; $i++)
                {
                    if(empty($_GET['Kind'.$i]))
                    {
                        $CheckMenu = "void";
                        break;
                    }

                    $Check = 0;
                    for($j = 0 ; $j < $_GET['Menu'] ; $j++)
                    {
                        if($_GET['Kind'.$i] == $_GET['Kind'.$j])
                        {
                            $Check++ ;
                        }
                        
                        if($Check == 2)
                        {
                            $CheckMenu = "double";
                            break;
                        }                            
                    }
                }
                return $CheckMenu;
            }
        }
    }

    function ManageSubMenu()
    {
        if(!empty($_GET['SubRequest']))
        {
            if($_GET['SubRequest'] == "+")
            {
                $Menu = $_GET['Menu'] + 1;
                return $Menu;
            }
            else if($_GET['SubRequest'] == "-")
            {
                $Menu = $_GET['Menu'] - 1;
                return $Menu; 
            }
            else if ( $_GET['SubRequest'] == "Ajouter")
            {
                $Menu = $_GET['Menu'];
                return $Menu;
            }
        }
    }

    function ManageMenu()
    {
        if(!empty($_GET['Request']) AND $_GET['Request']!='Search' 
        AND $_GET['Request']!='Ajouter une catégorie alimentaire' 
        AND $_GET['Request']!='Supprimer'
        AND $_GET['Request']!='Modifier'
        AND $_GET['Request']!='Modifier cette categorie'
        AND $_GET['Request']!='Supprimer cet aliment'
        AND $_GET['Request']!='Ajouter des aliments'
        )
        {
            if($_GET['Request'] == "+")
            {
                $Menu = $_GET['Menu'] + 1;
                return $Menu;
            }
            else if($_GET['Request'] == "-")
            {
                $Menu = $_GET['Menu'] - 1;
                return $Menu; 
            }
            else
            {
                $Menu = $_GET['Menu'];
                return $Menu;
            }
        }
    }

    function CheckMenu()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Ajouter")
            {
                $CheckMenu = "true";
                for($i = 0 ; $i < $_GET['Menu'] ; $i++)
                {
                    if(empty($_GET['Kind'.$i]))
                    {
                        $CheckMenu = "void";
                        break;
                    }

                    $Check = 0;
                    for($j = 0 ; $j < $_GET['Menu'] ; $j++)
                    {
                        if($_GET['Kind'.$i] == $_GET['Kind'.$j])
                        {
                            $Check++ ;
                        }
                        
                        if($Check == 2)
                        {
                            $CheckMenu = "double";
                            break;
                        }                            
                    }
                }
                return $CheckMenu;
            }
        }
    }
    
    function CheckCategorie()
    {
        if($_GET['Request'] == "Ajouter"
        || $_GET['Request'] == "Modifier cette categorie"
        || $_GET['Request'] == "Search")
        {
            if(!empty($_GET['Cat']))
            {
                $Cat = $_GET['Cat'];
                $Cat = mb_strtolower($Cat,"UTF-8");
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
    }

    function PrintListe($Liste)
    {
        
        $ListeFini=array(array(),array(),array(),array());
        for ($i = 0 ; $i < count($Liste[2]) ; $i++)
        {
           
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
                array_push($ListeFini[2][$i], $Liste[2][$i]);
                array_push($ListeFini[3][$i], $Liste[3][$i]);      
            }
        }
        return $ListeFini;
    }
 
    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelFoodCategories.php');
    Verif();
    $Categories = Categorie();
    $FoodPrint=CheckFood();
    $Foods = Food();
    $ID=CheckID();
    $CheckMenu=CheckMenu();
    $Menu=ManageMenu();
    $Menu2 = ManageSubMenu();
    $CheckMenu2 = CheckSubMenu();
    $CheckForm3 = CheckAddCat($CheckMenu2);
    if(!empty($_GET['Request']))
    {
        $Cat = CheckCategorie();
        
        $CheckFormAdd = CheckForm ($Cat, $CheckMenu);
        
        DeletCategorie();
        DeletFood();
        DeletFoods();
        DeletOneFood();
        
        $CheckFormUpdate = ModifCategorie($Cat);
        $Categories = SearchCategorie();
        
    }
    require("View/ViewFoodCategories.php");
?>