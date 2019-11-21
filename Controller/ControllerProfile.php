
<?php 

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
                echo("Un ou plusieurs champ(s) vide(s)");
                $_SESSION['modifier']=false; 

            } else if ($Mdp != $Cmdp)
            {
                echo("mdp different de la confirmation"); 
                $_SESSION['modifier']=false;
            
            } else if ($Mdp == $Cmdp)
            {
                $Mdp = base64_encode($Mdp);

                if ($Valeur == 0)
                {
                    echo("Vos modifications ont bien été appliquées");
                    $_SESSION['modifier']=true;
                } else if ($Valeur == 1)
                {
                    echo("Nom d'utilisateur ou e-mail déjà utilisé");
                    $_SESSION['modifier']=false;
                }
            }
        } else if (!empty($_GET['supprimer']) AND $_GET['supprimer']=='Oui')
        {
            session_destroy();
            header("Location:Index.php?supprimer=Oui");
        }
    }

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
            } else {
                $Choix="Non";
                return $Choix;
            }
        }
    }

    function Supp($Valeur) 
    {
        if ($Valeur == 0)
        {
            unset($_SESSION['modifier']);
        }
    }


    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckCo();
    require('Model/ModelProfile.php');
    $Choix=FindMdp();
    $Valeur=ModifProfil($Choix);
    DeleteUser();
    PrintProfile($Valeur);
    require('View/ViewProfil.php');
    Supp($Valeur);

?>
