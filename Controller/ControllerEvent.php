<?php

    function CheckMenu1()
    {
        if(!empty($_GET['event']))
        {
            if($_GET['event'] == "Ajouter un evenement")
            {
                $CheckMenu = "true";
                for($i = 0 ; $i < $_GET['Menu'] ; $i++)
                {
                    if(empty($_GET['recette'.$i]))
                    {
                        $CheckMenu = "void";
                        break;
                    }

                    $Check = 0;
                    for($j = 0 ; $j < $_GET['Menu'] ; $j++)
                    {
                        if($_GET['recette'.$i] == $_GET['recette'.$j])
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

    function ManageMenu1()
    {
        if(!empty($_GET['RequestRecipe'])
        AND ($_GET['RequestRecipe']=='+'
        OR $_GET['RequestRecipe']=='-')
        )
        {  
            if($_GET['RequestRecipe'] == "+")
            {
                $Menu = $_GET['MenuRecipe'] + 1;
                return $Menu;
            }
            else if($_GET['RequestRecipe'] == "-")
            {
                $Menu = $_GET['MenuRecipe'] - 1;
                return $Menu; 
            }
            
        }
    }

    function ManageMenu2()
    {
        if(!empty($_GET['RequestUser'])
        AND ($_GET['RequestUser']=='+'
        OR $_GET['RequestUser']=='-')
        )
        {  
            if($_GET['RequestUser'] == "+")
            {
                $MenuUser = $_GET['MenuUser'] + 1;
                return $MenuUser;
            }
            else if($_GET['RequestUser'] == "-")
            {
                $MenuUser = $_GET['MenuUser'] - 1;
                return $MenuUser; 
            }
            
        }
    }

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    CheckCo();
 
    if ($_SESSION['Co']==true)
    {
        $MenuRecipe=ManageMenu1();
        $MenuUser=ManageMenu2();
        require("Model/ModelEvent.php");
        $Events=SelectEvent();
        $Recipes=SelectRecipe();
        $Users=SelectUser();
        $UsersSupp=SelectSupp();
        $Guests=SelectGuest();
        $Dishes=SelectDish();
        $Invitation=Invitation();
        $PrintEvent=PrintEvent();
        $PrintUser=PrintUser();
        $SelectEvent=SelectModifEvent();
        $Intolerance=Intolerance();
        InsertEvent();
        ModifEvent();
        SuppEvent();
        AdInvitation();
        require("View/ViewEvent.php");
    }
?>
       