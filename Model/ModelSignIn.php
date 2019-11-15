<?php

    /* cherche si l'utilisateur existe dans la bdd, renvoi 1 si oui et 0 autrement */ 

    function CheckIdent ($Query)
    {
        if($Query == true)
        {
            $User = $_SESSION['User'];
            $Pwd = $_SESSION['Pwd'];
            $Bdd = new PDO("mysql:host=localhost;dbname=Plat_In","root","");
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
            $User = $_SESSION['User'];
            $Bdd = new PDO("mysql:host=localhost;dbname=Plat_In","root","");
            $Req = $Bdd -> prepare("SELECT ID_user FROM users WHERE user LIKE :user");
            $Req->bindParam(':user',$User,PDO::PARAM_STR);
            $Req->execute();
            $n = $Req -> fetch();
            $_SESSION['id'] = $n[0];
        }
    }

    /* connecte l'utilisateur */
    
    function ConBDD ($Check)
    {
        if($Check == 1 )
        {
            $ID = $_SESSION['id'];
            $Bdd = new PDO("mysql:host=localhost;dbname=Plat_In","root","");
            $Req = $Bdd -> prepare("UPDATE `users` SET `connection` = 'co' WHERE `users`.`ID_user` = :id ;");
            $Req->bindParam(':id',$ID,PDO::PARAM_STR);
            $Req->execute();
        }
    }
?>