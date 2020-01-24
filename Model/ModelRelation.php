<?php

        function Inserer()
        {
            $field = $_GET["status"];
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("INSERT INTO friends (ID_friend, ID_user, ID_user_receiver, status_f)
            VALUES (NULL,:utilisateur1,:utilisateur2,:status_f);");
            $Req -> bindParam(':utilisateur1',$_GET["utilisateur1"],PDO::PARAM_INT);
            $Req -> bindParam(':utilisateur2',$_GET["utilisateur2"],PDO::PARAM_INT);
            $Req -> bindParam(':status_f',$field,PDO::PARAM_STR);
            $Req -> execute();


        }


        function Modifier()
        {
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("UPDATE friends 
            SET 
            ID_user = :utilisateur1,
            ID_user_receiver = :utilisateur2,
            status_f = :status_f
            WHERE ID_friend = :ID_friend");
            $Req -> bindParam(':utilisateur1',$_GET["utilisateur1"],PDO::PARAM_INT);
            $Req -> bindParam(':utilisateur2',$_GET["utilisateur2"],PDO::PARAM_INT);
            $Req -> bindParam(':status_f',$_GET["status"],PDO::PARAM_STR);
            $Req -> bindParam(':ID_friend',$_GET["ID"],PDO::PARAM_INT);
            $Req -> execute();
        }

        function Supprimer()
        {
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("DELETE FROM friends 
            WHERE ID_friend = :ID_friend");
            $Req -> bindParam(':ID_friend',$_GET["ID"],PDO::PARAM_INT);
            $Req -> execute();
            
        }

        function ListeUtilisateur()
        {
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("SELECT ID_user,user FROM users");
            $Req -> execute();
            $ListeUtilisateur = $Req -> fetchall();
            return $ListeUtilisateur;
        }

        function Relation()
        {
    
            require("Model/ModelNewPDO.php");
            $Req = $Bdd -> prepare("SELECT ID_user,ID_user_receiver,status_f,ID_friend FROM friends");
            $Req -> execute();
            $Relation = $Req -> fetchall();
            return $Relation;
        }





?>