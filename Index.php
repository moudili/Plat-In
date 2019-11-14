<html>
    <head>
        <title>Plat'In</title>
    </head>
    <body>
        <?php
            // exporte Stable.php et appelle des fonctions
            require('Controller\ControllerStable.php');
            CheckSesion();
            CheckCo();

            /*$Bdd = new PDO("mysql:host=localhost;dbname=plat_in","root","");
            $Query = $Bdd->query("SELECT user, password FROM users");

            $Lignes = $Bdd->query("SELECT COUNT(ID_user) FROM users"); // Compter le nombre de lignes dans une table en fonction des ID.
            $Taille = $Lignes->fetch();
            $pass='a';

            for($i = 0 ; $i<$Taille[0] ; $i++) 
            {
                $Reponse = $Query->fetch();
                echo($Reponse[0]."        mdp : ".$Reponse[1]);

                if (password_verify($pass, $Reponse[1]))
                {
                    echo "Mot de passe correct";
                }
                else
                {
                    echo "Mot de passe incorrect";
                };
            };*/
        ?>
    </body>
</html>        