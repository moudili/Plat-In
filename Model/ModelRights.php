<?php

    function SearchUser ($User)
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Search")
            {

                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare('SELECT ID_user,user,picture,status_u FROM users WHERE status_u <> "'."admin".'" AND user LIKE "%'.$User.'%" ORDER BY user');
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

        }
        else
        {
            $User = "";
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare('SELECT ID_user,user,picture,status_u FROM users WHERE status_u <> "'."admin".'" AND user LIKE "%'.$User.'%" ORDER BY user');
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
    
    function Ban ()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Bannir")
            {
                if(!empty($_GET['Answer']))
                {
                    echo $_GET['id'];
                    require("Model/ModelNewPDO.php");
                    $Req = $Bdd -> prepare("UPDATE `users` SET `status_u` = 'ban' WHERE `users`.`ID_user` = :id ;");
                    $Req->bindParam(':id',$_GET['id'],PDO::PARAM_STR);
                    $Req -> execute();
                }
            }
        }
    }

    function UnBan ()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Débannir")
            {
                if(!empty($_GET['Answer']))
                {
                    echo $_GET['id'];
                    require("Model/ModelNewPDO.php");
                    $Req = $Bdd -> prepare("UPDATE `users` SET `status_u` = 'membre' WHERE `users`.`ID_user` = :id ;");
                    $Req->bindParam(':id',$_GET['id'],PDO::PARAM_STR);
                    $Req -> execute();
                }
            }
        }
    }

    function ManageRights()
    {
        if(!empty($_GET['Request']))
        {
            if($_GET['Request'] == "Modifier")
            {
                require("Model/ModelNewPDO.php");
                $Req = $Bdd -> prepare("SELECT status_u FROM users WHERE ID_user LIKE :id");
                $Req->bindParam(':id',$_GET['id'],PDO::PARAM_STR);
                $Req -> execute();
                $n = $Req -> fetch();
                $CheckRights =false;

                if($n[0] != $_GET['rights'])
                {
                    $Req = $Bdd -> prepare("UPDATE `users` SET `status_u` = :rights WHERE `users`.`ID_user` = :id ;");
                    $Req->bindParam(':id',$_GET['id'],PDO::PARAM_STR);
                    $Req->bindParam(':rights',$_GET['rights'],PDO::PARAM_STR);
                    $Req -> execute();
                    $CheckRights = true;                    
                }
                return  $CheckRights;

            }
        }
    }

?>