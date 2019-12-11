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

    function ManageMenu()
    {
        if(!empty($_GET['Request'])
        )
        {
            
            if($_GET['Request'] == "+")
            {
                //echo($_GET['Menu']);
                $Menu = $_GET['Menu'] + 1;
                //echo($Menu);
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

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    require('Model/ModelRecipe.php');
    $Menu=ManageMenu();
    $Origines=Origin();
    $Foods=Food();
    $CheckForm=InsertRecipe($Menu);
    $CheckMenu=CheckMenu();
    //InsertFood($Menu);
    $Recipes=Recipe();
    require("View/ViewRecipe.php");
?>     