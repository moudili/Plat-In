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

    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();

    require('Model/ModelDiet.php');
    $Kind = KindFood();
    $Menu = ManageMenu();
    $CheckMenu = CheckMenu();
    $Diet = CapsOff();
    $CheckForm = CheckDiet($CheckMenu,$Diet);

    require("View/ViewDiet.php");

    
?>