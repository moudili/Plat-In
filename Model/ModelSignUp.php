<?php

function ModelSignUp ($User,$FirstName,$LastName,$Adress,$Mail,$Phone,$Pwd,$CheckForm)
{
    if($CheckForm == true)
    {
        require('Model/ModelNewPDO.php');
        $Req = $Bdd -> prepare("SELECT count(ID_user) FROM users WHERE :user LIKE user OR :mail LIKE mail");
        $Req -> bindParam(':user',$User,PDO::PARAM_STR);
        $Req -> bindParam(':mail',$Mail,PDO::PARAM_STR);
        $Req -> execute();
        $n = $Req -> fetch();
        $CheckUser = $n[0];
        
        if ($CheckUser == 0) 
        {
            $Req = $Bdd->prepare("INSERT INTO users(user, u_password, statut) 
            VALUES(:user, :password, membre)");
            $Req->bindParam(':user', $User, PDO::PARAM_STR);
            $Req->bindParam(':password', $Pwd, PDO::PARAM_STR);
            $Req->execute();
        } 
        return $CheckUser;
    }
}
?>