<html>
    <head>
        <link rel="stylesheet" href="Css/ErrorChamp.css">
        <title>Profile</title>
    </head>
    
    <body>
        <?php

        require("View/ViewBanner.php"); 
        
        if (empty($_GET['modif']))
        {
            echo("<br>
                <p>Nom d'utilisateur : ".PrintProfil(SelectProfile())[0]."</p>
                <p>Prénom : ".PrintProfil(SelectProfile())[2]."</p>
                <p>Nom : ".PrintProfil(SelectProfile())[3]."</p>
                <p>Adresse :".PrintProfil(SelectProfile())[4]."</p>
                <p>Adresse e-mail :".PrintProfil(SelectProfile())[5]."</p>
                <p>Numéro de téléphone :".PrintProfil(SelectProfile())[6]."</p>
                <p>Mot de passe : ".PrintProfil(SelectProfile())[1]."</p>");
            echo("<form action='Index.php' method='get'>
            <input type='submit' name='modif' value='Modifier mon profil'>
            <input type='hidden' name='page' value='Profil'>
            </form>
            <form action='Controller/ControllerPreferences.php' method='get'>
            <input type='submit' value='Modifier mes préférences'>
            </form>
            <form action='Index.php' method='get'>
            <input type='hidden' name='modif' value='Supprimer mon profil'>
            <input type='submit' value='Supprimer mon compte'>
            <input type='hidden' name='page' value='Profil'>
            </form>");
        } 
        else if ($_GET['modif']=='Modifier mon profil')
        {
            echo("<br><form action='Index.php' method='get'>
                <p>Nom d'utilisateur : <input id='get_compte' type='text' name='ndu' value='".htmlspecialchars(PrintProfil(SelectProfile())[0], ENT_QUOTES)."' class=Aright></p>
                <p>Prénom : <input id='get_prenom' type='text' name='first_name' value='".htmlspecialchars(PrintProfil(SelectProfile())[2], ENT_QUOTES)."' class=Aright></p>
                <p>Nom : <input id='get_nom' type='text' name='last_name' value='".htmlspecialchars(PrintProfil(SelectProfile())[3], ENT_QUOTES)."' class=Aright></p>
                <p>Adresse : <input id='get_adresse' type='text' name='adresse' value='".htmlspecialchars(PrintProfil(SelectProfile())[4], ENT_QUOTES)."' class=Aright></p>
                <p>Adresse e-mail : <input id='get_mail' type='email' name='mail' value='".htmlspecialchars(PrintProfil(SelectProfile())[5], ENT_QUOTES)."' class=Aright></p>
                <p>Numéro de téléphone : <input id='get_phone' type='text' name='phone' value='".htmlspecialchars(PrintProfil(SelectProfile())[6], ENT_QUOTES)."' class=Aright></p>
                <p>Mot de passe : <input id='get_mdp' type='password' name='mdp' value='".htmlspecialchars(PrintProfil(SelectProfile())[1], ENT_QUOTES)."' class=Aright></p>
                <p>Confirmation de mot de passe : <input id='get_cmdp' type='password' name='cmdp' value=''></p>
                <input type='hidden' name='modif' value='Corriger'>
                <input type='submit' value='Modifier'>
                <input type='hidden' name='page' value='Profil'>
                </form>");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' value='Retour'>
                </form>");
        }
        else if ($_GET['modif']=='Supprimer mon profil')
        {
            echo("Etes-vous vraiment sûr de vouloir supprimer votre compte ?");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' name='supprimer'value='Oui'>
                </form>");
            echo("<form action='Index.php' method='get'>
                <input type='hidden' name='page' value='Profil'>
                <input type='submit' value='Non'>
                </form>");
        } 
        else if ($_SESSION['modifier']==true)
        {
            echo($_SESSION['erreur']."<br><form action='Index.php' method='get'>
            <input type='submit' value='Retour'>
            <input type='hidden' name='page' value='Profil'>
            </form>");
        } 
        else if ($_SESSION['modifier']==false)
        {
            echo"<br><form action='Index.php' method='get'>";
            
            if(empty($_GET['ndu']) 
            || strlen($_GET['ndu']) < 5
            || strlen($_GET['ndu']) > 40
            || $Valeur != 0
            )
            {
                echo"<p>Nom d'utilisateur : <input type='text' name='ndu' value='".htmlspecialchars($_GET['ndu'], ENT_QUOTES)."' class=Error></p>";
            }
            else
            {
                echo"<p>Nom d'utilisateur : <input type='text' name='ndu' value='".htmlspecialchars($_GET['ndu'], ENT_QUOTES)."' class=Aright></p>";
            }
            
            if(empty($_GET['first_name'])
            || strlen($_GET['first_name']) < 2
            || strlen($_GET['first_name']) > 40
            || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['first_name'])
            )
            {
                echo"<p>Prénom : <input type='text' name='first_name' value='".htmlspecialchars($_GET['first_name'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Prénom : <input type='text' name='first_name' value='".htmlspecialchars($_GET['first_name'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['last_name'])
            || strlen($_GET['last_name']) < 2
            || strlen($_GET['last_name']) > 40
            || !preg_match("#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['last_name'])
            )
            {
                echo"<p>Nom : <input type='text' name='last_name' value='".htmlspecialchars($_GET['last_name'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Nom : <input type='text' name='last_name' value='".htmlspecialchars($_GET['last_name'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['adresse'])
            || strlen($_GET['adresse']) < 2
            || strlen($_GET['adresse']) > 40
            || !preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ '._-]+$#", $_GET['adresse'])
            )
            {
                echo"<p>Adresse : <input type='text' name='adresse' value='".htmlspecialchars($_GET['adresse'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Adresse : <input type='text' name='adresse' value='".htmlspecialchars($_GET['adresse'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['mail'])
            || !preg_match("#^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'._-]{2,30}+@[a-z0-9._-]{2,10}\.[a-z]{2,4}$#", $_GET['mail'])
            || $Valeur != 0
            )
            {
                echo"<p>Adresse e-mail : <input type='email' name='mail' value='".htmlspecialchars($_GET['mail'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Adresse e-mail : <input type='email' name='mail' value='".htmlspecialchars($_GET['mail'], ENT_QUOTES)."'class=Aright></p>";
            }

            if(empty($_GET['phone'])
            || !preg_match('#^(0|\+33)[1-9]{1}\d{8}$#' , $_GET['phone'])
            )
            {
                echo"<p>Numéro de téléphone : <input type='text' name='phone' value='".htmlspecialchars($_GET['phone'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Numéro de téléphone : <input type='text' name='phone' value='".htmlspecialchars($_GET['phone'], ENT_QUOTES)."'class=Aright></p>";
            }
            if(empty($_GET['mdp']) 
            || strlen($_GET['mdp']) < 5
            || strlen($_GET['mdp']) > 40    
            )
            {
                echo"<p>Mot de passe : <input type='password' name='mdp' value='".htmlspecialchars($_GET['mdp'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Mot de passe : <input type='password' name='mdp' value='".htmlspecialchars($_GET['mdp'], ENT_QUOTES)."'class=Aright></p>";
            }
            if(empty($_GET['cmdp'])
            || $_GET['mdp'] != $_GET['cmdp']
            )
            {
                echo"<p>Confirmation de mot de passe : <input type='password' name='cmdp' value='".htmlspecialchars($_GET['cmdp'], ENT_QUOTES)."'class=Error></p>";
            }
            else
            {
                echo"<p>Confirmation de mot de passe : <input type='password' name='cmdp' value='".htmlspecialchars($_GET['cmdp'], ENT_QUOTES)."'class=Aright></p>";
            }


            echo"<input type='hidden' value='Corriger' name='modif'>
            <p><FONT color='red'>
            ".($_SESSION['erreur']."
            </FONT></p>
            <input type='submit' value='Modifier'>
            <input type='hidden' name='page' value='Profil'>
            </form>
            </div>");
            echo("<form action='Index.php' method='get'>
            <input type='hidden' name='page' value='Profil'>
            <input type='submit' value='Retour'>
            </form>");
        }
        ?>
    </body>
</html>