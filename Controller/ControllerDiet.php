<?php

    function ManageMenu()
    {
        if(!empty($_GET['Request']))
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
            else if ($_GET['Request'] == "Ajouter un régime"
            || $_GET['Request'] == "Ajouter")
            {
                $Menu = $_GET['Menu'];
                return $Menu;
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

    function CapsOff()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Ajouter")
            {
                $Diet = $_GET['Diet'];
                $Diet = mb_strtolower($Diet,"UTF-8");
                return $Diet;
            }
        }
    }

    function CheckDeletCat()
    {
        if(empty($_GET['Request']))
        {
            if(!empty($_GET['SubRequest']))
            {
                if($_GET['SubRequest'] == "Supprimer")
                {
                    header('Location: /Plat-In/Index.php?page=R%C3%A9gimes');
                }
            }
        }
    }
    

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();

    require('Model/ModelDiet.php');
    $Kind = KindFood();
    $Menu = ManageMenu();
    $CheckMenu = CheckMenu();
    $Diet = CapsOff();
    $CheckForm = CheckDiet($CheckMenu,$Diet);
    $PrintDiet = PrintDiet();
    DeletCat();
    CheckDeletCat();
    DeletDiet();
    $CheckForm2 = EditDiet ();
    $Menu2 = ManageSubMenu();
    $CheckMenu2 = CheckSubMenu();
    $CheckForm3 = CheckAddCat($CheckMenu2);

    require("View/ViewDiet.php");
    

    
?>