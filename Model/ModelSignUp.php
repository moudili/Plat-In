<?php

function ModelSignUp ($Ndu, $FirstName, $LastName, $Adresse, $Mail, $Phone, $Mdp, $Cmdp) 
{

    $Bdd = new PDO("mysql:host=localhost;dbname=plat_in","root","");
    $Query = $Bdd->query("SELECT user, mail FROM users");
    $Lignes = $Bdd->query("SELECT COUNT(ID_user) FROM users"); // Compter le nombre de lignes dans une table en fonction des ID.

    $Taille = $Lignes->fetch();
    $Test = false;
    for($i = 0 ; $i<$Taille[0] ; $i++) 
    {
                    
        $Reponse = $Query->fetch();
        
        if($Ndu != $Reponse[0] && $Mail != $Reponse[1])
        {
            $Test = true;
        }else
        {
            $Test = false;
        }
    };

    if ($Test == true) 
    {
        $Mdp = password_hash($Mdp, PASSWORD_DEFAULT);
        $Req = $Bdd->prepare("INSERT INTO users(user, password, first_name, last_name, adress, mail, phone_number) 
        VALUES(:user, :password, :first_name, :last_name, :adress, :mail, :phone_number)");
            
        $Req->bindParam(':user', $Ndu, PDO::PARAM_STR);
        $Req->bindParam(':password', $Mdp, PDO::PARAM_STR);
        $Req->bindParam(':first_name', $FirstName, PDO::PARAM_STR);
        $Req->bindParam(':last_name', $LastName, PDO::PARAM_STR);
        $Req->bindParam(':adress', $Adresse, PDO::PARAM_STR);
        $Req->bindParam(':mail', $Mail, PDO::PARAM_STR);
        $Req->bindParam(':phone_number', $Phone, PDO::PARAM_STR);
        /*$Req->bindParam(':status_u', 'membre', PDO::PARAM_STR);
        $Req->bindParam(':connection', 'dc', PDO::PARAM_STR);*/

        $Req->execute();
        $_SESSION["create"]=true;

    } else 
    {
        $_SESSION["create"]=false;
        $_SESSION["erreur"]="Nom d'utilisateur ou e-mail déjà utilisé";
    };
}
?>