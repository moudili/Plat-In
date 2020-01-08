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
        $MesRequetes = ShowRequest();
        $MesInvitations = MyRequest();

        
        //var_dump($_SESSION);





        if($_GET['Request'] == "Search")
        {
            $MesBloques = BlockPeople();
            $MoiBloquer = Myblocked();
            $Myfriends = MyFriend();
            
            if (!empty($_GET['Answer']) AND $_GET['Answer']=='Oui')
            {
                RequestToBeFriend();

            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer']=='Non') 
            {
                echo("non");
            }

        }elseif ($_GET['Request'] == "Amis")
        {
            $Myfriends = MyFriend();
            if (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Oui') 
            {
                DeleteFriend();            
            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Non')
            {
                
            }
            
        }
        elseif ($_GET['Request'] == "Accepter amis")
        {
            if (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Oui') 
            {
                AcceptRequest();
            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Non')
            {
            
            }
        }
        elseif ($_GET['Request'] == "Refuser ami") {
            if (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Oui') 
            {
                DeclineRequest();
            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Non')
            {
                
            }
        }
        elseif ($_GET['Request'] == "Bloquer")
        {
            if (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Oui') 
            {
                Block();
            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Non')
            {
                
            }
            
        }
        elseif ($_GET['Request'] == "Debloquer") 
        {
            if (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Oui') 
            {
                Debloquer();
            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Non')
            {
                
            }
        }



    require("View/ViewSocial.php"); 
    }





?>
       