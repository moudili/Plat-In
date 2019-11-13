<?php
    function ($user,$mdp)
    {
        $bdd = new PDO("mysql:host=localhost;dbname=Plat_In","root","");
        $req = $bdd -> prepare("SELECT count(ID_user) FROM users WHERE :user LIKE user AND :mdp LIKE u_password ");
        $req -> bindParam(':user',$user,PDO::PARAM_STR);
        $req -> bindParam(':mdp',$mdp,PDO::PARAM_STR);
        $req -> execute();
        $n = $req -> fetch();
        return $n[0]; 
    }
?>