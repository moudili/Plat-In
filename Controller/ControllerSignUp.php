<html>
    <head>
        <title> </title>
    </head>
    
    <body>
        <?php

        function CheckValidatio($Valeur) 
        {
            if ($Valeur == 1)
            {
                $_SESSION["create"]=true;
            } else if ($Valeur == 0)
            {
                $_SESSION["create"]=false;
                $_SESSION["erreur"]="Nom d'utilisateur ou e-mail déjà utilisé";
            }
        };

        function CheckMdp()
        {
            session_start();
            $Ndu = $_GET['ndu'];
            $FirstName = $_GET['first_name'];
            $LastName = $_GET['last_name'];
            $Adresse = $_GET['adresse'];
            $Mail = $_GET['mail'];
            $Phone = $_GET['phone'];
            $Mdp = $_GET['mdp'];
            $Cmdp = $_GET['cmdp'];

            if (empty($_GET['ndu']) 
                OR empty($_GET['first_name'])
                OR empty($_GET['last_name'])
                OR empty($_GET['adresse'])
                OR empty($_GET['mail'])
                OR empty($_GET['phone'])
                OR empty($_GET['mdp'])
                OR empty($_GET['cmdp'])) 
            {
                $_SESSION["create"]=false;
                $_SESSION["erreur"]="Un ou plusieurs champ(s) vide(s)";
            } else if ($Mdp != $Cmdp)
            {
                $_SESSION["create"]=false;
                $_SESSION["erreur"]="mdp different de la confirmation"; 
            } else if ($Mdp == $Cmdp)
            {
                $Mdp = base64_encode($Mdp);
                require('../Model/ModelSignUp.php');
                ModelSignUp ($Ndu, $FirstName, $LastName, $Adresse, $Mail, $Phone, $Mdp, $Cmdp);
                CheckValidatio(ModelSignUp ($Ndu, $FirstName, $LastName, $Adresse, $Mail, $Phone, $Mdp, $Cmdp));
            };
        
        };

        ?>

    </body>
</html>