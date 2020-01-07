<?php
    function CheckMenu()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Valider")
            {
                $CheckMenu = "true";
                for($i = 0 ; $i < $_GET['Menu'] ; $i++)
                {
                    if(empty($_GET['food'.$i]))
                    {
                        $CheckMenu = "void";
                        break;
                    }

                    $Check = 0;
                    for($j = 0 ; $j < $_GET['Menu'] ; $j++)
                    {
                        if($_GET['food'.$i] == $_GET['food'.$j])
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

    function CheckMenu2()
    {
        if(!empty($_GET['RequestModif']))
        {
            if($_GET['RequestModif'] == "Confirmation")
            {
                $CheckMenu = "true";
                for($i = 0 ; $i < $_GET['Menu'] ; $i++)
                {
                    if(empty($_GET['food'.$i]))
                    {
                        $CheckMenu = "void";
                        break;
                    }

                    $Check = 0;
                    for($j = 0 ; $j < $_GET['Menu'] ; $j++)
                    {
                        if($_GET['food'.$i] == $_GET['food'.$j])
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

    function ManageMenu()
    {
        if(!empty($_GET['Request'])
        AND $_GET['Request']!='Afficher'
        AND $_GET['Request']!='Supprimer'
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

    function ManageMenu2()
    {
        if(!empty($_GET['RequestModif']))
        {
            if($_GET['RequestModif'] == "+")
            {
                $Menu = $_GET['Menu'] + 1;
                return $Menu;
            }
            else if($_GET['RequestModif'] == "-")
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

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelRecipe.php');
    $Menu=ManageMenu();
    $Menu2=ManageMenu2();
    $Origines=Origin();
    $Foods=Food();
    $CheckForm=InsertRecipe($Menu);
    $CheckMenu=CheckMenu();
    $CheckMenu2=CheckMenu2();
    $Recipes=Recipe();
    $NewFoods=ModifFood();
    ModifRecipes($Menu2);
    SuppRecipe();
    starts();
    $Note=PrintStarts($Recipes[6]);
    //print_r(PrintStarts($Recipes[6]));
    require("View/ViewRecipe.php");
?>     