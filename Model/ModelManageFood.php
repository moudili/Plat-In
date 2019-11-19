<?php
         $Bdd = new PDO("mysql:host=localhost;dbname=Plat_In","root","root");
         $Req = $objetPdo->prepare('SELECT ID_food, food_name FROM foods');
         $Req->execute();
?>