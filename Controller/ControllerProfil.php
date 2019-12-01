
<?php 

/* Vérifie si les conditions sont réunis pour la modification du compte */ 

    function PrintProfile($Valeur) 
    {
        if (!empty($_GET['modif']) AND $_GET['modif']=='Corriger')
        { 
            unset($_SESSION['erreur']);
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
                $_SESSION['erreur']="Un ou plusieurs champ(s) vide(s)";
                $_SESSION['modifier']=false; 

            } 
            else if (strlen($_GET['ndu']) < 5)
            {
                $_SESSION["modifier"] = false;
                $_SESSION["erreur"] = "Le nom d'utilisateur doit faire plus de 5 caractères";

            } 
            else if (strlen($_GET['first_name']) < 2)
            {
                $_SESSION["modifier"] = false;
                $_SESSION["erreur"] = "Le prenom doit faire plus de 2 caractères";

            } 
            else if (strlen($_GET['last_name']) < 2)
            {
                $_SESSION["modifier"] = false;
                $_SESSION["erreur"] = "Le nom doit faire plus de 2 caractères";

            } 
            else if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $Mail))
            {
                $_SESSION["modifier"] = false;
                $_SESSION["erreur"] = "Veuillez rentrer une adresse e-mail valide";

            }
            else if(!preg_match('#^(0|\+33)[6-7]{1}\d{8}$#' , $Phone))
            {
                $_SESSION["modifier"] = false;
                $_SESSION["erreur"] = "Veuillez rentrer un numéro de téléphone valide";
                    
            }
            else if (strlen($_GET['mdp']) < 5)
            {
                $_SESSION["modifier"] = false;
                $_SESSION["erreur"] = "Le mot de passe doit faire plus de 5 caractères";

            }
            else if ($Mdp != $Cmdp)
            {
                $_SESSION['erreur']="mdp different de la confirmation"; 
                $_SESSION['modifier']=false;
            
            } 
            else if ($Mdp == $Cmdp)
            {
                $Mdp = base64_encode($Mdp);

                if ($Valeur == 0)
                {
                    $_SESSION['erreur']="Vos modifications ont bien été appliquées";
                    $_SESSION['modifier']=true;
                    $_SESSION['User']=$Ndu;
                } 
                else if ($Valeur == 1)
                {
                    $_SESSION['erreur']="Nom d'utilisateur ou e-mail déjà utilisé";
                    $_SESSION['modifier']=false;
                }
            }
        } 
        else if (!empty($_GET['supprimer']) AND $_GET['supprimer']=='Oui')
        {
            session_destroy();
            header("Location:Index.php?supprimer=Oui");
        }
    }

/* Vérifie si le mot de passe est identique a la confirmation */

    function FindMdp()
    {
        if (!empty($_GET['modif']) AND $_GET['modif']=='Corriger')
        { 
            $Mdp = $_GET['mdp'];
            $Cmdp = $_GET['cmdp'];

            if ($Mdp == $Cmdp)
            {
               $Choix="Oui"; 
               return $Choix;
            } 
            else 
            {
                $Choix="Non";
                return $Choix;
            }
        }
    }

/* Supprime la valeur d'une variable*/

    function Supp($Valeur) 
    {
        if ($Valeur == 0)
        {
            unset($_SESSION['modifier']);

        }
    }


    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckCo2();
 
    if ($_SESSION['Co']==true)
    {
        require('Model/ModelProfil.php');
        $Choix=FindMdp();
        $Valeur=ModifProfil($Choix);
        DeleteUser();
        PrintProfile($Valeur);
        require('View/ViewProfil.php');
        Supp($Valeur);
    }

?>
