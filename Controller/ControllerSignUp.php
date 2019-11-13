<html>
    <head>
        <title> </title>
    </head>
    
    <body>
        <?php

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

            if ($Mdp != $Cmdp) 
            {
                $_SESSION["create"]=false;
                $_SESSION["erreur"]="mdp different de la confirmation";
            } else 
            {
                require('..\Model\ModelSignUp.php');
                ModelSignUp ($Ndu, $FirstName, $LastName, $Adresse, $Mail, $Phone, $Mdp, $Cmdp);
            };
        
        };

        ?>

    </body>
</html>