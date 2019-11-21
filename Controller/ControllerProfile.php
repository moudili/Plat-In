
<?php 

    function PrintProfile() 
    {
        
        if (empty($_GET['modif']) AND empty($_GET['supprimer']))
        {
            require('Model/ModelProfile.php');
            require('View/ViewProfil.php');
        } else if ($_GET['modif']=='Modifier mon profil')
        {
            require('Model/ModelProfile.php');
            require('View/ViewProfil.php');
        } else if ($_GET['modif']=='Corriger')
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
                require('View/ViewProfil.php');

            } else if ($Mdp != $Cmdp)
            {
                echo("mdp different de la confirmation"); 
                $_SESSION['modifier']=false;
                require('View/ViewProfil.php');
            } else if ($Mdp == $Cmdp)
            {
                $Mdp = base64_encode($Mdp);
                require('Model/ModelProfile.php');
                $Valeur=ModifProfil();

                if ($Valeur == 0)
                {
                    echo("Vos modifications ont bien été appliquées");
                    $_SESSION['modifier']=true;
                    require('View/ViewProfil.php');
                    unset($_SESSION['modifier']);
                } else if ($Valeur == 1)
                {
                    echo("Nom d'utilisateur ou e-mail déjà utilisé");
                    $_SESSION['modifier']=false;
                    require('View/ViewProfil.php');
                }
            }
        } else if ($_GET['modif']=='Supprimer mon profil')
        {
            require('View/ViewProfil.php');
        } else if ($_GET['supprimer']=='Oui')
        {
            require('Model/ModelProfile.php');
            DeleteUser();
            session_destroy();
            header("Location:Index.php?supprimer=Oui");
        }
    }

    require('Controller/ControllerStable.php');
    CheckSesion();
    CheckCo();
    PrintProfile();
?>
