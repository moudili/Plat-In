<?php

function ModelSignUp ($Ndu, $FirstName, $LastName, $Adresse, $Mail, $Phone, $Mdp) 
{

    require('Model\ModelNewPDO.php');
    $Req = $Bdd -> prepare("SELECT count(ID_user) FROM users WHERE :user LIKE user OR :mail LIKE mail ");
    $Req -> bindParam(':user',$Ndu,PDO::PARAM_STR);
    $Req -> bindParam(':mail',$Mail,PDO::PARAM_STR);
    $Req -> execute();
    $n = $Req -> fetch();
    $Check = $n[0];

    
    if ($Check == 0) 
    {
        $Req = $Bdd->prepare("INSERT INTO users(user, u_password, first_name, last_name, adress, mail, phone_number, status_u, connection) 
        VALUES(:user, :password, :first_name, :last_name, :adress, :mail, :phone_number, 'membre', 'dc')");
            
        $Req->bindParam(':user', $Ndu, PDO::PARAM_STR);
        $Req->bindParam(':password', $Mdp, PDO::PARAM_STR);
        $Req->bindParam(':first_name', $FirstName, PDO::PARAM_STR);
        $Req->bindParam(':last_name', $LastName, PDO::PARAM_STR);
        $Req->bindParam(':adress', $Adresse, PDO::PARAM_STR);
        $Req->bindParam(':mail', $Mail, PDO::PARAM_STR);
        $Req->bindParam(':phone_number', $Phone, PDO::PARAM_STR);

        $Req->execute();
        return $Check;

    } else if ($Check == 1)
    {
        return $Check;
    };
}
?>