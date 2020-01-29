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
        }else
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
    
    function RequestToBeFriend()
    {
        $field = 'requested';
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("INSERT INTO friends (ID_friend,ID_user,ID_user_receiver,status_f) VALUES (NULL,:ID_user,:ID_user_receiver,:status_f);");
        $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> bindParam(':ID_user_receiver',$_GET['id'],PDO::PARAM_INT);
        $Req -> bindParam(':status_f',$field,PDO::PARAM_STR);
        $Req -> execute();
    }

    function MyFriend()
    {

        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("SELECT DISTINCT T1.ID, user FROM (
        SELECT ID_user AS ID FROM Plat_In.friends WHERE ID_user_receiver = :ID_user AND status_f = 'friend'
        UNION
        SELECT ID_user_receiver AS ID FROM Plat_In.friends WHERE (ID_user = :ID_user  AND status_f = 'friend')
        ) AS T1
        INNER JOIN Plat_In.users ON T1.ID = ID_user
        ;");
        $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $MesAmis = $Req -> fetchall();
        return $MesAmis;

    }

    function DeleteFriend()
    {
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("DELETE FROM friends WHERE (ID_user_receiver = :ID_user AND ID_user = :ID_user_server ) 
                                                       OR (ID_user_receiver = :ID_user_server AND ID_user = :ID_user )");
        $Req -> bindParam(':ID_user_server',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> bindParam(':ID_user',$_GET['id'],PDO::PARAM_INT);
        $Req -> execute();


    }

    function ShowRequest()
    {
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("SELECT DISTINCT T1.ID, user FROM (
            SELECT ID_user AS ID FROM Plat_In.friends WHERE (ID_user_receiver = :ID_user  AND status_f = 'requested')
            ) AS T1
            INNER JOIN Plat_In.users ON T1.ID = ID_user
            ;");
            $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $Mesrequetes = $Req -> fetchall();
        return $Mesrequetes;
        
    }

    function MyRequest()
    {
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("SELECT DISTINCT T1.ID, user FROM (
            SELECT ID_user_receiver AS ID FROM Plat_In.friends WHERE (ID_user = :ID_user  AND status_f = 'requested')
            ) AS T1
            INNER JOIN Plat_In.users ON T1.ID = ID_user
            ;");
            $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $MesInvitations = $Req -> fetchall();
        return $MesInvitations;
    }

    Function AcceptRequest()
    {
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("UPDATE friends SET status_f = 'friend' WHERE ID_user_receiver = :ID_user AND id_user = :ID_sender AND status_f = 'requested'");
        $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> bindParam(':ID_sender',$_GET['id'],PDO::PARAM_INT);
        $Req -> execute();
    
    }

    Function DeclineRequest()
    {
        echo($_SESSION['id']."".$_GET['id']);
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("DELETE FROM friends WHERE ((ID_user_receiver = :ID_user AND ID_user = :ID_user_server ) 
                                                       OR (ID_user_receiver = :ID_user_server AND ID_user = :ID_user ))
                                                       AND status_f = 'requested'");
        $Req -> bindParam(':ID_user_server',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> bindParam(':ID_user',$_GET['id'],PDO::PARAM_INT);
        $Req -> execute();
    }

    /* bloquer une personne */ 
    Function Block()
    {
        $field = 'block';
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("INSERT INTO friends (ID_friend,ID_user,ID_user_receiver,status_f) VALUES (NULL,:ID_user,:ID_user_receiver,:status_f);");
        $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> bindParam(':ID_user_receiver',$_GET['id'],PDO::PARAM_INT);
        $Req -> bindParam(':status_f',$field,PDO::PARAM_STR);
        $Req -> execute();
    }


    Function Debloquer()
    {
        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("DELETE FROM friends WHERE ID_user = :ID_user AND ID_user_receiver = :ID_user_receiver  AND status_f = 'block' ");
        $Req -> bindParam(':ID_user_receiver',$_GET['id'],PDO::PARAM_INT);
        $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
    }

    /* voir les personnes bloquer */
    function BlockPeople()
    {

        require("Model/ModelNewPDO.php");
        $Req = $Bdd -> prepare("SELECT F.ID_friend,U.user,F.status_f,F.ID_user FROM Plat_In.users U 
        JOIN Plat_In.friends F 
        WHERE U.ID_user LIKE F.ID_user_receiver AND F.ID_user = :ID_user AND  F.status_f = 'block';
        ");
        $Req -> bindParam(':ID_user',$_SESSION['id'],PDO::PARAM_INT);
        $Req -> execute();
        $MesBloques = $Req -> fetchall();
        return $MesBloques;
    }

        function MyBlocked()
        {
    
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("SELECT F.ID_friend,U.user,F.status_f,F.ID_user_receiver FROM Plat_In.users U 
            JOIN Plat_In.friends F 
            WHERE U.ID_user LIKE F.ID_user AND (F.ID_user_receiver = :ID_user_receiver AND  F.status_f = 'block');
            ");
            $Req -> bindParam(':ID_user_receiver',$_SESSION['id'],PDO::PARAM_INT);
            $Req -> execute();
            $MesBloques = $Req -> fetchall();
            return $MesBloques;
        }
   
?>