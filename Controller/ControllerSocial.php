<?php

    function CheckUser()
    {
        if(!empty($_GET['Request']))
        {
            if(isset($_GET['Usr']) && $_GET['Request'] == "Search")
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
            
            if (isset($_GET['Answer']) && $_GET['Answer']=='Oui')
            {
                RequestToBeFriend();
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");

            }
            elseif (isset($_GET['Answer']) && $_GET['Answer']=='Non') 
            {
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");
            }

        }elseif ($_GET['Request'] == "Amis")
        {
            $Myfriends = MyFriend();
            if (isset($_GET['Answer']) && $_GET['Answer'] == 'Oui') 
            {
                DeleteFriend();
                header("Location:Index.php?page=Sociale&Request=Amis");            
            }
            elseif (isset($_GET['Answer']) && $_GET['Answer'] == 'Non')
            {
                header("Location:Index.php?page=Sociale&Request=Amis");

            }
            
        }
        elseif ($_GET['Request'] == "Accepter amis")
        {
            if (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Oui') 
            {
                AcceptRequest();
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");
                
            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Non')
            {
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");
            }
        }
        elseif ($_GET['Request'] == "Refuser ami") {
            if (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Oui') 
            {
                DeclineRequest();
                header("Location:Index.php?page=Sociale&Request=Amis");
            }
            elseif (!empty($_GET['Answer']) AND $_GET['Answer'] == 'Non')
            {
                header("Location:Index.php?page=Sociale&Request=Amis");
            }
        }
        elseif ($_GET['Request'] == "Bloquer")
        {
            if (isset($_GET['Answer']) && $_GET['Answer'] == 'Oui') 
            {
                Block();
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");
            }
            elseif (isset($_GET['Answer']) && $_GET['Answer'] == 'Non')
            {
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");
            }

        }
        elseif ($_GET['Request'] == "Debloquer") 
        {
            if (isset($_GET['Answer']) && $_GET['Answer'] == 'Oui') 
            {
                Debloquer();
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");
            }
            elseif (isset($_GET['Answer']) && $_GET['Answer'] == 'Non')
            {
                header("Location:Index.php?Usr=&page=Sociale&Request=Search");
            }
            
        }



    require("View/ViewSocial.php"); 
    }





?>
       