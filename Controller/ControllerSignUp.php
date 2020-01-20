<?php

    function CheckField()
    {
        if (!empty($_GET['SignUp']))
        {
            $User = $_GET['User'];
            $FirstName = $_GET['FirstName'];
            $LastName = $_GET['LastName'];
            $Adress = $_GET['Adress'];
            $Mail = $_GET['Mail'];
            $Phone = $_GET['Phone'];
            $Pwd = $_GET['Pwd'];
            $Cpwd = $_GET['Cpwd'];
            
            $Phone = str_replace(" ", "", $Phone);
            $Data = array($User,$FirstName,$LastName,$Adress,$Mail,$Phone);

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
                $_SESSION["Error"] = "Il y a un ou plusieurs champ(s) vide(s)";
                $CheckForm = false; 
            }
            else if (strlen($_GET['User']) < 5)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Le nom d'utilisateur doit faire plus de 5 caractères";
                $CheckForm = false; 
            }
            else if (strlen($_GET['User']) > 40)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Le nom d'utilisateur doit faire moins de 40 caractères";
                $CheckForm = false; 
            }
            else if (strlen($_GET['FirstName']) < 2)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Le prenom doit faire plus de 2 caractères";
                $CheckForm = false; 
            }
            else if (strlen($_GET['FirstName']) > 40)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Le prenom doit faire moins de 40 caractères";
                $CheckForm = false; 
            }
            else if (!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $FirstName))
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Ce prenom n'est pas correcte";
                $CheckForm = false; 
            }
            else if (strlen($_GET['LastName']) < 2)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Le nom doit faire plus de 2 caractères";
                $CheckForm = false; 
            }
            else if (strlen($_GET['LastName']) > 40)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Le nom doit faire moins de 40 caractères";
                $CheckForm = false; 
            }
            else if (!preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $LastName))
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Ce nom n'est pas correcte";
                $CheckForm = false; 
            }
            else if (strlen($_GET['Adress']) < 2)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Votre adresse doit faire plus de 2 caractères";
                $CheckForm = false; 
            }
            else if (strlen($_GET['Adress']) > 40)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Votre adresse doit faire moins de 40 caractères";
                $CheckForm = false; 
            }
            else if (!preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $Adress))
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Cette adresse n'est pas correcte";
                $CheckForm = false; 
            }
            else if (!preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'._-]{2,30}+@[a-z0-9._-]{2,10}\.[a-z]{2,4}$#", $Mail))
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Veuillez rentrer une adresse e-mail valide";
                $CheckForm = false; 
            }
            else if(!preg_match('#^(0|\+33)[1-9]{1}\d{8}$#' , $Phone))
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
            else if (strlen($_GET['Pwd']) > 40)
            {
                $_SESSION["Create"] = false;
                $_SESSION["Error"] = "Le mot de passe doit faire moins de 40 caractères";
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

    function CheckUser($CheckUser,$CheckForm)
    {
        if($CheckForm == true)
        {
            if ($CheckUser == 0)
            {
                $_SESSION["Create"]=true;
            } 
            else
            {
                $_SESSION["Create"]=false;
                $_SESSION["Error"]="Ce nom d'utilisateur ou cette adresse e-mail est déjà utilisé";
            }
        }
    }

    function CleanVariable()
    {
        unset($_SESSION['Create']);
        unset($_SESSION['Error']);
    }

    require('ControllerStaple.php');
    CheckSesion();
    $Data = CheckField();
    require('Model/ModelSignUp.php');
    $CheckUser = ModelSignUp($Data[0],$Data[1],$Data[2],$Data[3],$Data[4],$Data[5],$Data[6],$Data[7]);
    CheckUser($CheckUser,$Data[7]);
    require("View/ViewSignUp.php");
    CleanVariable();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="Controller/Main.js"></script>