<?php

    function CheckUser()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Search")
            {
                $Usr = $_GET['Usr'];
                $Usr = strtolower($Usr);
                return $Usr;
            }
        }
    }
                          
    require('Controller/ControllerStaple.php');
    CheckSesion();
    CheckLogOut();
    CheckCo();

    if ($_SESSION['Co']==true)
    {
        $User = CheckUser();
        require('Model/ModelSocial.php');
        $Search = SearchUser($User);
        
        var_dump($_SESSION);





        if($_GET['Request'] == "Search")
        {
            $Myfriends = MyFriend();
            if ($_GET['Answer']=='Oui')
            {
                RequestToBeFriend();

            }
            elseif ($_GET['Answer']=='Non') 
            {
                echo("non");
            }

        }elseif ($_GET['Request'] == "Amis")
        {
            $Myfriends = MyFriend();
            if ($_GET['Answer'] == 'Oui') 
            {
                DeleteFriend();
                
                                
            }
            elseif ($_GET['Answer'] == 'Non')
            {
                
            }
            
        }
        elseif ($_GET['Request'] == "Demande amis") {
        
            $MesRequetes = ShowRequest();
            if ($_GET['Answer'] == 'Oui') 
            {
                echo("oui");
                AcceptRequest();
                                
            }
            elseif ($_GET['Answer'] == 'Non')
            {
                
            }
        }


    require("View/ViewSocial.php"); 
    }





?>
       