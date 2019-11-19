<?php
    
    require("Model/ModelNewPDO.php");

     /* deconnecte un utilisateur */
     
     $ID = $_SESSION['id'];
     $Req = $Bdd -> prepare("UPDATE `users` SET `connection` = 'dc' WHERE `users`.`ID_user` = :id ;");
     $Req->bindParam(':id',$ID,PDO::PARAM_STR);
     $Req->execute();
?>