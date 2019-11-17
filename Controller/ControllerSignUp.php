<html>
    <head>
        <title> </title>
    </head>
    
    <body>
        <?php

        function CheckField()
        {
            if (!empty($_GET['SignUp']))
            {
                $User = $_GET['User'];
                $FirstName = $_GET['FirstName'];
                $LastName = $_GET['LastName'];
                $Adresse = $_GET['Adress'];
                $Mail = $_GET['Mail'];
                $Phone = $_GET['Phone'];
                $Pwd = $_GET['Pwd'];
                $Cpwd = $_GET['Cpwd'];
                
                $Phone = str_replace(" ", "", $Phone);
                $Data = array($User,$FirstName,$LastName,$Adresse,$Mail,$Phone);

                if (empty($_GET['User']) 
                    OR empty($_GET['FirstName'])
                    OR empty($_GET['LastName'])
                    OR empty($_GET['Adress'])
                    OR empty($_GET['Mail'])
                    OR empty($_GET['Phone'])
                    OR empty($_GET['Pwd'])
                    OR empty($_GET['Cpwd'])) 
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Un ou plusieurs champ(s) vide(s)";
                    $CheckForm = false; 
                }
                else if (strlen($_GET['User']) < 5)
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Le nom d'utilisateur doit faire plus de 5 caractères";
                    $CheckForm = false; 
                }
                else if (strlen($_GET['FirstName']) < 2)
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Le prenom doit faire plus de 2 caractères";
                    $CheckForm = false; 
                }
                else if (strlen($_GET['LastName']) < 2)
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Le nom doit faire plus de 2 caractères";
                    $CheckForm = false; 
                }
                else if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $Mail))
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Veuillez rentrer une adresse e-mail valide";
                    $CheckForm = false; 
                }
                else if(!preg_match('#^(0|\+33)[6-7]{1}\d{8}$#' , $Phone))
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Veuillez rentrer un numéro de téléphone valide";
                    $CheckForm = false;                      
                }
                else if (strlen($_GET['Pwd']) < 5)
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Le mot de passe doit faire plus de 5 caractères";
                    $CheckForm = false; 

                }                                                                
                else if ($Pwd != $Cpwd)
                {
                    $_SESSION["Create"] = false;
                    $_SESSION["Error"] = "Mot de passe different de la confirmation";
                    $CheckForm = false; 
                }
                else if ($Pwd == $Cpwd)
                {
                    $Pwd = base64_encode($Pwd);
                    $CheckForm = true;                    
                }
                array_push($Data, $Pwd , $CheckForm);
                return $Data;
            }
        }

        function CheckUser($Check,$CheckForm)
        {
            if($CheckForm == true)
            {
                if ($Check == 0)
                {
                    $_SESSION["Create"]=true;
                } 
                else if ($Check == 1)
                {
                    $_SESSION["Create"]=false;
                    $_SESSION["Error"]="Nom d'utilisateur ou e-Mail déjà utilisé";
                }
            }
        }

        function CleanVariable()
        {
            unset($_SESSION['Create']);
            unset($_SESSION['Error']);
        }

        ?>

    </body>
</html>