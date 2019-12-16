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
        SELECT ID_user AS ID FROM Plat_In.friends WHERE ID_user_receiver = :ID_user and status_f = 'accepted'
        UNION
        SELECT ID_user_receiver AS ID FROM Plat_In.friends WHERE (ID_user = :ID_user  AND status_f = 'accepted')
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
        





    }


?>