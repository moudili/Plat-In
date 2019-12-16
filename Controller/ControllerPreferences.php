<?php
    function CheckMenu()
    {
        if(!empty($_GET['Request']) && $_GET['Request'] == '+')
        {
            $Menu = $_GET['Menu'] + 1;
            return $Menu;
        }
        else if(!empty($_GET['Request']) && $_GET['Request'] == '-')
        {
            $Menu = $_GET['Menu'] - 1;
            return $Menu;
        }
        else if(!empty($_GET['Request']) && $_GET['Request'] == 'Valider')
        {
            $Menu = $_GET['Menu'];
            return $Menu;            
        }
    }

    function CheckSubMenu1()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Valider")
            {
                $CheckMenu1 = "true";
                for($i = 0 ; $i < $_GET['Menu'] && $_GET['Menu'] != 1 ; $i++)
                {
                    if(empty($_GET['Diet'.$i]))
                    {
                        $CheckMenu1 = "void";
                        break;
                    }

                    $Check1 = 0;
                    for($j = 0 ; $j < $_GET['Menu'] ; $j++)
                    {
                        if($_GET['Diet'.$i] == $_GET['Diet'.$j])
                        {
                            $Check1++ ;
                        }
                        
                        if($Check1 == 2)
                        {
                            $CheckMenu1 = "double";
                            break;
                        }                            
                    }
                }
                return $CheckMenu1;
            }
        }
    }

    function CheckSubMenu2()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Valider")
            {
                $CheckMenu2 = "true";
                for($i = 0 ; $i < 3 ; $i++)
                {
                    if(empty($_GET['Food'.$i]))
                    {
                        $CheckMenu2 = "void";
                        break;
                    }

                    $Check2 = 0;
                    for($j = 0 ; $j < 3 ; $j++)
                    {
                        if($_GET['Food'.$i] == $_GET['Food'.$j])
                        {
                            $Check2++ ;
                        }
                        
                        if($Check2 == 2)
                        {
                            $CheckMenu2 = "double";
                            break;
                        }                            
                    }
                }
                return $CheckMenu2;
            }
        }
    }

    function redirect($Check1,$Check2)
    {
        if($Check1 == "true" && $Check2 == "true")
        {
            header("Location:../Index.php");
        }
    }

    require('../Model/ModelPreferences.php');
    $PrintDiet = PrintDiet();
    $PrintFood = PrintFood();
    $Menu = CheckMenu();
    $CheckMenu1 = CheckSubMenu1();
    $CheckMenu2 = CheckSubMenu2();
    redirect($CheckMenu1,$CheckMenu2);
    require('../View/ViewPreferences.php');
?>