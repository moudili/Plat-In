<?php

    /* Selectionne le profil connecte*/

    function SelectProfile()
    {
        require('Model/ModelNewPDO.php');
        $User = $_SESSION['User'];
        $Req = $Bdd -> prepare("SELECT ID_user FROM users WHERE :user LIKE user");
        $Req -> bindParam(':user',$User,PDO::PARAM_STR);
        $Req -> execute();
        $n = $Req -> fetch();
        $Check = $n[0];
        return $Check;

    };

    /* Permet de selectionner toutes les infos du profil qui est connecté */

    function PrintProfil($Id)
    {
        require('Model/ModelNewPDO.php');
        $ID = $_SESSION['id'];
        $Req = $Bdd -> prepare("SELECT user, u_password, first_name, last_name, adress, mail, phone_number FROM users WHERE $ID LIKE ID_user");
        $Req -> execute();
        $n = $Req -> fetch();
        $Print = array();
        for ($i=0; $i < 7; $i++)
        {
            if ($i==1)
            {
                array_push($Print, base64_decode($n[$i]));
            } else 
            {
                array_push($Print, $n[$i]);
            }
        }
        return $Print;
    } 

    /* */

    function ModifProfil($Choix)
    {
        if (!empty($_GET['modif']) AND $_GET['modif']=='Corriger' AND $Choix == "Oui")
        {
            require("Model/ModelNewPDO.php");

            $ID = $_SESSION['id'];
            $Ndu = $_GET['ndu'];
            $FirstName = $_GET['first_name'];
            $LastName = $_GET['last_name'];
            $Adresse = $_GET['adresse'];
            $Mail = $_GET['mail'];
            $Phone = $_GET['phone'];
            $Mdp = $_GET['mdp'];
            $Mdp = base64_encode($Mdp);

            $Req = $Bdd -> prepare("SELECT count(ID_user) FROM users WHERE :id <> ID_user AND (:user LIKE user OR :mail LIKE mail)");
            $Req -> bindParam(':id',$ID,PDO::PARAM_STR);
            $Req -> bindParam(':user',$Ndu,PDO::PARAM_STR);
            $Req -> bindParam(':mail',$Mail,PDO::PARAM_STR);
            $Req -> execute();
            $n = $Req -> fetch();
            $Check = $n[0];

            if ($Check==0)
            {
                $Req = $Bdd -> prepare("UPDATE `users` SET `user` = :user, `u_password` = :u_password, `first_name` = :first_name, `last_name` = :last_name, `adress` = :adress, `mail` = :mail, `phone_number` = :phone_number  WHERE `users`.`ID_user` = :id ;");
                $Req->bindParam(':id',$ID,PDO::PARAM_STR);
                $Req->bindParam(':user', $Ndu, PDO::PARAM_STR);
                $Req->bindParam(':u_password', $Mdp, PDO::PARAM_STR);
                $Req->bindParam(':first_name', $FirstName, PDO::PARAM_STR);
                $Req->bindParam(':last_name', $LastName, PDO::PARAM_STR);
                $Req->bindParam(':adress', $Adresse, PDO::PARAM_STR);
                $Req->bindParam(':mail', $Mail, PDO::PARAM_STR);
                $Req->bindParam(':phone_number', $Phone, PDO::PARAM_STR);

                $Req->execute();
                return $Check;
            } 
            else 
            {
                return $Check;
            }
        }
    }

    function DeleteUser()
    {
        if (!empty($_GET['supprimer']) AND $_GET['supprimer']=='Oui')
        {
            $ID = $_SESSION['id'];
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("DELETE FROM users WHERE :id LIKE ID_user");
            $Req->bindParam(':id',$ID,PDO::PARAM_STR);
            $Req->execute();
        }
    }
?>