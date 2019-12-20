<?php

    function SearchUser ($User)
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Search")
            {
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare('SELECT ID_user,user,picture FROM users WHERE user <> "'.$_SESSION['User'].'" AND status_u <> "'."admin".'" AND user LIKE "%'.$User.'%" ORDER BY user');
                $Req -> execute();
                $User = array(array(),array(),array());
                if($Req->rowCount() > 0)
                {
                    while($n = $Req -> fetch())
                    {
                        array_push($User[0], $n[0]);
                        array_push($User[1], $n[1]);
                        array_push($User[2], $n[2]);               
                    }
                }
                else
                {
                    $User = false;
                }
                return $User;
            }
        }
        else
        {
            $User = "";
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare('SELECT ID_user,user,picture,status_u FROM users WHERE status_u <> "'."admin".'" AND ID_user <> "'.$_SESSION['id'].'" AND user LIKE "%'.$User.'%" ORDER BY user');
            $Req -> execute();
            $User = array(array(),array(),array(),array());
            if($Req->rowCount() > 0)
            {
                while($n = $Req -> fetch())
                {
                    array_push($User[0], $n[0]);
                    array_push($User[1], $n[1]);
                    array_push($User[2], $n[2]);
                    array_push($User[3], $n[3]);               
                }
            }
            else
            {
                $User = false;
            }

        }
        return $User;
    }    

?>