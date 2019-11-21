<?php 

    /* cherche si l'utilisateur existe dans la bdd, renvoi 1 si oui et 0 autrement */ 

    function CheckIdent ($Query)
    {
        if($Query == true)
        {
            require("Model/ModelNewPDO.php");
            $User = $_SESSION['User'];
            $Pwd = $_SESSION['Pwd'];
            $Req = $Bdd -> prepare("SELECT count(ID_user) FROM users WHERE :user LIKE user AND :pwd LIKE u_password ");
            $Req -> bindParam(':user',$User,PDO::PARAM_STR);
            $Req -> bindParam(':pwd',$Pwd,PDO::PARAM_STR);
            $Req -> execute();
            $n = $Req -> fetch();
            $Check = $n[0];
            return $Check;
        }
    }

    /* cherche l'ID d'un utilisateur dans la BDD */

    function GetID ($Check)
    {
        if($Check == 1 )
        {
            require("Model/ModelNewPDO.php");
            $User = $_SESSION['User'];
            $Req = $Bdd -> prepare("SELECT ID_user,status_u FROM users WHERE user LIKE :user");
            $Req->bindParam(':user',$User,PDO::PARAM_STR);
            $Req->execute();
            $n = $Req -> fetch();
            $_SESSION['id'] = $n[0];
            $_SESSION['status_u'] = $n[1];
        }
    }

    /* connecte l'utilisateur */
    
    function ConBDD ($Check)
    {
        if($Check == 1 )
        {
            require("Model/ModelNewPDO.php");
            $ID = $_SESSION['id'];
            $Req = $Bdd -> prepare("UPDATE `users` SET `connection` = 'co' WHERE `users`.`ID_user` = :id ;");
            $Req->bindParam(':id',$ID,PDO::PARAM_STR);
            $Req->execute();
        }
    }
?>