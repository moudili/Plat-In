<?php

function ModelSignUp ($Ndu, $FirstName, $LastName, $Adresse, $Mail, $Phone, $Mdp, $Cmdp) {

    $Bdd = new PDO("mysql:host=localhost;dbname=plat_in","root","");
    $Query = $Bdd->query("SELECT user, mail FROM users");
    $Lignes = $Bdd->query("SELECT COUNT(ID_user) FROM users"); // Compter le nombre de lignes dans une table en fonction des ID.

    $Taille = $Lignes->fetch();
    
    for($i = 0 ; $i<$Taille[0] ; $i++) {
                    
        $Reponse = $Query->fetch();
        
        if($Ndu != $Reponse[0] && $Mail != $Reponse[1]){
            $Test = true;
        }else{
            $Test = false;
        }
    }

    if ($Test == true) 
    {
        $Req = $Bdd->prepare("INSERT INTO users(user, password, first_name, last_name, adress, mail, phone_number, status_u, connection) 
        VALUES(:user, :password, :first_name, :last_name, :adress, :mail, :phone_number, :status_u, :connection)");
            
        $Req->bindParam(':user', $Ndu, PDO::PARAM_STR);
        $Req->bindParam(':password', $Mdp, PDO::PARAM_STR);
        $Req->bindParam(':first_name', $FirstName, PDO::PARAM_STR);
        $Req->bindParam(':last_name', $LastName, PDO::PARAM_STR);
        $Req->bindParam(':adress', $Adresse, PDO::PARAM_STR);
        $Req->bindParam(':mail', $Mail, PDO::PARAM_STR);
        $Req->bindParam(':phone_number', $Phone, PDO::PARAM_STR);
        $Req->bindParam(':status_u', 'membre', PDO::PARAM_STR);
        $Req->bindParam(':connection', 'dc', PDO::PARAM_STR);

        $Req->execute();
        echo('<input id="hidden" name="create" type="hidden" value="true">');

    } else 
    {
        echo('
        <input id="hidden" name="ndu" type="hidden" value="'.$Ndu.'">
        <input id="hidden" name="paswword" type="hidden" value="'.$Mdp.'">
        <input id="hidden" name="first_name" type="hidden" value="'.$FirstName.'">
        <input id="hidden" name="last_name" type="hidden" value="'.$LastName.'">
        <input id="hidden" name="adresse" type="hidden" value="'.$Adresse.'">
        <input id="hidden" name="mail" type="hidden" value="'.$Mail.'">
        <input id="hidden" name="phone_number" type="hidden" value="'.$Phone.'">
        <input id="hidden" name="create" type="hidden" value="false">
        ');
    };
}
?>