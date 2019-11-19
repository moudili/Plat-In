<?php
     /* deconnecte un utilisateur */
     $ID = $_SESSION['id'];
     $Bdd = new PDO("mysql:host=localhost;dbname=Plat_In","root","root");
     $Req = $Bdd -> prepare("UPDATE `users` SET `connection` = 'dc' WHERE `users`.`ID_user` = :id ;");
     $Req->bindParam(':id',$ID,PDO::PARAM_STR);
     $Req->execute();
?>